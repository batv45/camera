<template>
    <AppLayout>
        kayıtlar
    </AppLayout>
</template>

<script>
import AppLayout from "../../../Layouts/AppLayout";
export default {
    components: {AppLayout},
    metaInfo:{title: "Kamera Kayıtları"},

    name: "Index",
    props:{
        camera:String,
        record:String,
        records:Array
    }
}
</script>

<style scoped>

</style>
