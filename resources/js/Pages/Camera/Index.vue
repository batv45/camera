<template>
    <AppLayout>
        <PageHeader>
            <h2 class="page-title">Kamera Listesi</h2>
        </PageHeader>
        <div class="row mb-3" v-if="camid">
            <div class="col-lg-4">
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Kamera Adı</label>
                    <div class="col">
                        <input type="email" v-model="camName" class="form-control">
                        <small class="form-hint">Kamera ID: <span class="strong">{{ camid }}</span></small>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" @click.prevent="camRename()">Kaydet</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="table-responsive">
                        <table
                            class="table table-vcenter">
                            <thead>
                            <tr>
                                <th>Kamera</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="cam in cameras">
                                <td>
                                    <span v-if="camNames.hasOwnProperty(cam)">{{ camNames[cam] }} <small class="">- {{cam}}</small></span>
                                    <span v-else>{{ cam }}</span>
                                    </td>
                                <td>
                                    <div class="d-flex">
                                        <span  title="Yeniden Adlandır"><a href="#" @click.preve.prevent="camid=cam"><PencilIcon/></a></span>
                                        <span class="pe-1">–</span>
                                        <Link :href="route('camera.show',cam)">Görüntüle</Link>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";
import AppLayout from "../../Layouts/AppLayout";
import PageHeader from "../../Components/PageHeader";
export default {
    components: {PageHeader, AppLayout, Link},
    metaInfo:{title: "Kameralar"},
    name: "Index",
    props:{
        camera_dir:String,
        cameras:Array
    },
    data(){
        return {
            camName: null,
            camid:null,
            camNames:[]
        }
    },
    beforeMount() {
        this.camNames = JSON.parse(localStorage.getItem('camNames'))
        this.getCameras()
    },
    mounted() {
    },
    methods:{
        camRename(){
            axios.post(route('api.setcamname'),{
                camid:this.camid,
                camname:this.camName
            }).then((response)=>{
                this.camNames = response.data
                localStorage.setItem('camNames',JSON.stringify(this.camNames))
            })
            this.camName = null
            this.camid = null
        },
        getCameras(){
            axios.get(route('api.getcameras')).then((response)=>{
                this.camNames = response.data
                localStorage.setItem('camNames',JSON.stringify(this.camNames))
            })
        }
    }
}
</script>

<style scoped>

</style>
