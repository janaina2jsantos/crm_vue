<template>
    <div id="left">
        <img v-bind:src="'/storage/images/hamburger.png'" alt="" />
        <div class="profile">
            <h1>Hi, Jana</h1>
            <h2>Let´s make projects more amazing</h2>
        </div>
        <div class="search">
            <input type="" name="" placeholder="Search your project" />
            <img v-bind:src="'/storage/images/search.png'" alt="" />
        </div>

        <div class="project">
            <h3>Projects <span>(18)</span></h3>
            <div class="projects">
                <div class="a-project">
                    <div class="box-color">
                        <img v-bind:src="'/storage/images/overlay.png'" alt="" />
                        <span>PT</span>
                    </div>
                    <h6>Development</h6>
                </div>
                <div class="a-project">
                    <div class="box-color">
                        <img v-bind:src="'/storage/images/overlay.png'" alt="" />
                        <span>PT</span>
                    </div>
                    <h6>Design</h6>
                </div>
                <div class="a-project">
                    <div class="box-color">
                        <img v-bind:src="'/storage/images/overlay.png'" alt="" />
                        <span>PT</span>
                    </div>
                    <h6>Testing</h6>
                </div>
                <div class="a-project">
                    <div class="box-color">
                        <img v-bind:src="'/storage/images/overlay.png'" alt="" />
                        <span>PT</span>
                    </div>
                    <h6>Medium Draft</h6>
                </div>
                <div class="a-project">
                    <div class="box-color">
                        <img v-bind:src="'/storage/images/overlay.png'" alt="" />
                        <span>PT</span>
                    </div>
                    <h6>Landing Page</h6>
                </div>
                <div class="a-project">
                    <div class="box-color">
                        <img v-bind:src="'/storage/images/plus.png'" alt="" />
                        <span>PT</span>
                    </div>
                    <h6>Add Project</h6>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    }
</script>
