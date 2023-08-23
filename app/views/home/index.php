<div id="homeDashboard" class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">QuestWise Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Completed Quests
                </div>
                <div class="card-body">
                    <canvas id="weeklyChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Recent Quests
                </div>
                <div class="card-body">
                    <ul class="list-group" id="tasks">
                        <li class="list-group-item text-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>