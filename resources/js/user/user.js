$(function () {
    fillWeeklyChart();
});

const dayNames = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

function fillWeeklyChart() {
    try {
        const data = JSON.parse($('#weeklyCompletedTasks').val());
        const taskCounts = populateTaskCounts(data);
        renderWeeklyChart(dayNames, taskCounts);
    } catch (error) {
        console.log(error);
    }
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