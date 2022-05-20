<template>
    <div id="right">
        <h1>Development CRM</h1>
        <div class="horizontal">
            <img v-bind:src="'/storage/images/horizontal.png'" alt="" />
        </div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

        <!-- Today Tasks -->
        <div class="upcoming">
            <div class="add-tasks">
                <h2>Today´s Task</h2>
                <div class="add-action">
                    <img v-bind:src="'/storage/images/add.png'" alt=""/>
                </div>
            </div>

            <ul class="tasks-list"> 
                <li v-for="task, key in todayTasks" :key="task.id">
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input type="checkbox" name="" v-bind:checked="task.completed" v-on:change="finishTodayTask(task.id)" v-bind:disabled="task.completed == '1'"/>
                                <span v-bind:class="{none: !task.completed, opaque: task.completed}"></span>
                            </label>
                            <h4 v-bind:class="{none: !task.completed, overline: task.completed}">{{ task.title }}</h4>
                        </div>
                        <div class="right">
                            <img v-bind:src="'/storage/images/edit.png'" alt="" v-bind:class="{none: !task.completed, opaque: task.completed}"/>
                            <img v-bind:src="'/storage/images/del.png'" alt="" v-on:click="deleteTodayTask(task.id)" />
                            <button v-bind:class="{inprogress: !task.completed, completed: task.completed}">
                                {{ task.completed ? "Completed" : "In progress" }}
                           </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Upcoming Tasks -->
        <div class="upcoming">
            <div class="add-tasks">
                <h2>Upcoming</h2>
                <div class="add-action">
                    <img v-bind:src="'/storage/images/add.png'" alt=""/>
                </div>
            </div>
            <form action="" v-on:submit="addUpcomingTask($event)">
                <input type="text" name="" v-model="newTask"/>
            </form>
            <ul class="tasks-list">
                <li v-for="task, key in upcomingTasks" :key="task.id">
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input type="checkbox" name="" v-bind:checked="task.completed" v-on:change="checkUpcomingTask(task.id)"/>
                                <span></span>
                            </label>
                            <h4>{{ task.title }}</h4>
                        </div>
                        <div class="right">
                            <img v-bind:src="'/storage/images/edit.png'" alt=""/>
                            <img v-bind:src="'/storage/images/del.png'" alt="" v-on:click="deleteUpcomingTask(task.id)"/>
                            <button v-bind:class="{ inprogress: !task.approved, approved: task.approved }">
                                {{ task.waiting ? "Waiting" : "In test" }}
                           </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                urlUpcoming: "http://localhost:8000/api/upcoming",
                urlToday: "http://localhost:8000/api/today",
                todayTasks: [],
                upcomingTasks: [],
                newTask: "",
            }
        },
        methods: {
            // *** Upcoming Tasks
            // Get all the tasks
            fetchUpcomingTasks() {
                fetch(this.urlUpcoming)
                    .then(response => response.json()) 
                    .then(data => {
                        this.upcomingTasks = data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            // Add a new task
            addUpcomingTask(e) {
                e.preventDefault();
                if (this.upcomingTasks.length > 4) {
                    alert("Please complete the existing tasks before add a new one!");
                }
                else {
                    let config = {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Accept': 'application/json'
                        }
                    }

                    let formData = new FormData();
                    formData.append('task_id', Math.random().toString(36).substring(7));
                    formData.append('title', this.newTask);
                    formData.append('waiting', 1);

                    // making the request to API
                    axios.post(this.urlUpcoming, formData, config)
                        .then(response => {
                            this.fetchUpcomingTasks();
                            // setTimeout(function() {
                            //     alert("Task created successfully!");
                            // },200);
                        })
                        .catch(errors => {
                            console.log(errors);
                        })

                    // reseting new task
                    this.newTask = "";
                }
            },
            // Check task
            checkUpcomingTask(id) {
                // console.log(this.todayTasks.length);
                if (this.todayTasks.length > 4) {
                    alert("Sorry, complete your existing tasks first!");
                    // location.href = "/";
                }
                else {
                    // adding the task to todays table
                    this.addTodayTask(id);

                    // deleting the task from db (upcomings table)
                    let url = "http://localhost:8000/api/upcoming/"+id;
                    axios.delete(url)
                        .then(response => {
                            this.fetchUpcomingTasks();
                        })
                        .catch(errors => {
                            console.log(errors);
                        })

                }
            },
            // Delete task
            deleteUpcomingTask(id) {
                let url = "http://localhost:8000/api/upcoming/"+id;
                if (confirm("Do you really want to delete this task?")) {
                    // making the request to API
                    axios.delete(url)
                        .then(response => {
                            this.fetchUpcomingTasks();
                            // setTimeout(function() {
                            //     alert("Task deleted successfully!");
                            // },200);
                        })
                        .catch(errors => {
                            console.log(errors);
                        })
                }
            },
            // *** Today Tasks
            fetchTodayTasks() {
                fetch(this.urlToday)
                    .then(response => response.json()) 
                    .then(data => {
                        this.todayTasks = data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            addTodayTask(id) {
                let obj = this.upcomingTasks.find(i => i.id == id);
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json'
                    }
                }

                let formData = new FormData();
                formData.append('task_id', Math.random().toString(36).substring(7));
                formData.append('title', obj.title);

                // making the request to API
                axios.post(this.urlToday, formData, config)
                    .then(response => {
                        // console.log(response);
                        this.fetchTodayTasks();
                    })
                    .catch(errors => {
                        console.log(errors);
                    })
            },
            finishTodayTask(id) {
                let url = "http://localhost:8000/api/today/"+id;
                if (confirm("Task concluded?")) {
                    let config = {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Accept': 'application/json'
                        }
                    }

                    if (this.todayTasks.length > 4) {
                        // getting the first task from array
                        let firstTask = this.todayTasks.slice(0, 1);
                        // delete
                        this.deleteFirstTask(firstTask[0].id);
                    }

                    axios.put(url, config)
                        .then(response => {
                            this.fetchTodayTasks();
                        })
                        .catch(errors => {
                            console.log(errors);
                        })
                }   
            },
            // Delete task
            deleteTodayTask(id) {
                let obj = this.todayTasks.find(i => i.id == id);
                let url = "http://localhost:8000/api/today/"+id;
                if (confirm("Do you really want to delete this task?")) {
                    axios.delete(url)
                        .then(response => {
                            this.fetchTodayTasks();
                        })
                        .catch(errors => {
                            console.log(errors);
                        })
                } 
            },
            deleteFirstTask(id) {
                let obj = this.todayTasks.find(i => i.id == id);
                let url = "http://localhost:8000/api/today/"+id;
                axios.delete(url)
                    .then(response => {
                        this.fetchTodayTasks();
                    })
                    .catch(errors => {
                        console.log(errors);
                    })
            }
        },
        mounted() {
            this.fetchTodayTasks();
            this.fetchUpcomingTasks();
        }
    }
</script>

