$(function () {
    fillWeeklyChart();
    fillTasks();
});

function generateTaskListItem(task) {
    let dueDateSpan = "";
    if (task.due_date && task.status !== 'Completed') {
        const dueDate = new Date(task.due_date);
        const formattedDueDate = `${dueDate.getDate().toString().padStart(2, '0')}.${(dueDate.getMonth() + 1).toString().padStart(2, '0')}.${dueDate.getFullYear()}`;
        dueDateSpan = `<span class="badge bg-danger rounded-pill">${formattedDueDate}</span>`;
    }

    const badgeClass = task.status === 'Completed' ? 'bg-success' : 'bg-primary';
    return `
        <li class="list-group-item d-flex justify-content-between align-items-center task-item" onclick="navigateToTask(${task.task_id})">
            ${task.title}
            <span>
                <span class="badge ${badgeClass} rounded-pill">${task.status}</span>
                ${dueDateSpan}
            </span>
        </li>
    `;
}

async function fillTasks() {
    try {
        const tasks = await fetchData('/questwise/home/quests');

        const list = $('#tasks');
        list.empty();

        for (const task of tasks) {
            list.append(generateTaskListItem(task));
        }
    } catch (error) {
        console.error(error);
    }
}

const dayNames = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

async function fetchData(url) {
    const response = await fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    if (!response.ok) {
        throw new Error('Failed to fetch data');
    }

    return response.json();
}

function populateTaskCounts(data) {
    const taskCounts = [0, 0, 0, 0, 0, 0, 0];

    for (let i = 0; i < data.length; i++) {
        const day = dayNames.indexOf(data[i].day_name);
        if (day !== -1) {
            taskCounts[day] = data[i].count;
        }
    }

    return taskCounts;
}

function renderWeeklyChart(labels, data) {
    const ctx = document.getElementById('weeklyChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tasks',
                backgroundColor: '#00a65a',
                borderColor: '#00a65a',
                data: data
            }]
        },
        options: {
            legend: {
                display: false
            },
        }
    });
}

async function fillWeeklyChart() {
    try {
        const data = await fetchData('/questwise/home/weekly-quest');
        const taskCounts = populateTaskCounts(data);
        renderWeeklyChart(dayNames, taskCounts);
    } catch (error) {
        console.log(error);
    }
}

function navigateToTask(id) {
    window.location.href = `/questwise/quest/${id}`;
}