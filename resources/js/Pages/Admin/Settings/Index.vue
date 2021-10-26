<template>
    <AppLayout>
        <PageHeader>
            <div class="col">
                <h2 class="page-title"><adjustments-icon></adjustments-icon> Sistem Ayarları</h2>
            </div>
        </PageHeader>
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <form method="post" @submit.prevent="sendPost">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Kamera Ana Dizini</label>
                                <div class="col">
                                    <input type="text" class="form-control" aria-describedby="cameraDir" v-model="$page.props.camera_dir">
                                    <small class="form-hint">Kamera kayıtlarını yedeklendiği ana dizini giriniz.</small>
                                </div>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary"><check-icon></check-icon> Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "../../../Layouts/AppLayout";
import PageHeader from "../../../Components/PageHeader";
export default {
    metaInfo:{
        title:"Sistem Ayarları"
    },
    name: "Index",
    components: {PageHeader, AppLayout},
    props:{
      'camera_dir':String,
    },
    data(){
        return {
        }
    },
    methods:{
        sendPost(){
            this.$inertia.post(route('admin.settings.update'),{
                'camera_dir':this.camera_dir
            }).then((response)=>{
                console.log(response)
            })
        }
    }
}
</script>

<style scoped>

</style>
