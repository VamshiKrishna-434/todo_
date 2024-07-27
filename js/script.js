document.addEventListener('DOMContentLoaded', function () {
    fetchTasks();
    fetchOnlineUsers();
});

function addTask() {
    const title = document.getElementById('task-title').value;
    const desc = document.getElementById('task-desc').value;
    const dueDate = document.getElementById('due-date').value;
    const dueTime = document.getElementById('due-time').value;
    const priority = document.getElementById('priority').value;
    const isPersonal = document.getElementById('personal').checked ? 1 : 0;
    const assignedTo = document.getElementById('assign-to').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/add_task.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status === 200) {
            alert('Task added successfully');
            fetchTasks();
        } else {
            alert('Error adding task');
        }
    };
    xhr.send(`title=${title}&desc=${desc}&due_date=${dueDate}&due_time=${dueTime}&priority=${priority}&personal=${isPersonal}&assigned_to=${assignedTo}`);
}

function fetchTasks() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/get_tasks.php', true);
    xhr.onload = function () {
        if (this.status === 200) {
            const tasks = JSON.parse(this.responseText);
            displayTasks(tasks);
        }
    };
    xhr.send();
}

function fetchOnlineUsers() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/fetch_online_users.php', true);
    xhr.onload = function () {
        if (this.status === 200) {
            const users = JSON.parse(this.responseText);
            displayOnlineUsers(users);
        }
    };
    xhr.send();
}

function displayTasks(tasks) {
    const personalTasks = tasks.filter(task => task.is_personal);
    const assignedTasks = tasks.filter(task => !task.is_personal);

    document.getElementById('personal-tasks').innerHTML = personalTasks.map(task => `<li>${task.title}</li>`).join('');
    document.getElementById('assigned-tasks').innerHTML = assignedTasks.map(task => `<li>${task.title}</li>`).join('');
}

function displayOnlineUsers(users) {
    document.getElementById('online-users').innerHTML = users.map(user => `<img src="avatar_placeholder.png" alt="${user.email}">`).join('');
}

function updateProgress(taskId, progress) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/update_progress.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status === 200) {
            alert('Progress updated successfully');
            fetchTasks();
        } else {
            alert('Error updating progress');
        }
    };
    xhr.send(`task_id=${taskId}&progress=${progress}`);
}

function logout() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/logout.php', true);
    xhr.onload = function () {
        if (this.status === 200) {
            window.location.href = 'index.html';
        } else {
            alert('Error logging out');
        }
    };
    xhr.send();
}
