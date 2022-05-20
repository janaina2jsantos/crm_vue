<template>
    <div id="body">
        <leftbody-component></leftbody-component>
        <rightbody-component></rightbody-component>
    </div>
</template>

<script>
    import LeftBodyComponent from "./LeftBodyComponent";
    import RightBodyComponent from "./RightBodyComponent";

    export default {
        components: {
            LeftBodyComponent,
            RightBodyComponent
        }
    }
</script>
