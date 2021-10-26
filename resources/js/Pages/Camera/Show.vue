<template>
    <AppLayout>
        <PageHeader back-text="Kameralar" :back-url="route('camera.index')">
            <div class="col">
                <h2 class="page-title">Kamera Kayıtları</h2>
            </div>
        </PageHeader>
        <div class="row row-cards mb-3">
            <div class="col-md-4 col-xl-3" v-for="cams in cameras">
                <Link class="card card-link" :href="route('camera.show',cams)">
                    <div v-if="cams === camera" class="card-status-bottom bg-primary"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div v-if="camNames.hasOwnProperty(cams)" class="font-weight-medium">{{ camNames[cams] }} <small class="">- {{cams}}</small></div>
                                <div v-else class="font-weight-medium">{{ cams }}</div>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
        <div class="row" v-if="video_url !== null">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <button @click.prevent="video_url = null" type="button" class="btn btn-danger btn-sm">Kapat</button>
                    </div>
                    <video :src="video_url" width="640px" height="380p" autoplay/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="card">
                    <div class="table-responsive">
                        <table
                            class="table table-vcenter">
                            <thead>
                            <tr>
                                <th>Kayıt Tarihleri</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="cam in camdirs">
                                <td>{{ splitcam(cam) }}</td>
                                <td>
                                    <Link
                                        v-if="record !== cam.split('/')[1]"
                                        :href="route('camera.record.show',{camera:camera,record:cam.split('/')[1]})">Görüntüle</Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3" v-if="records">
                <div class="card">
                    <div class="table-responsive">
                        <table
                            class="table table-vcenter">
                            <thead>
                            <tr>
                                <th>Kayıtlar</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="rec in records">
                                <td>{{ splitrec(rec).split('_')[1].replace('.mp4','')| momentunix  }}</td>
                                <td>
                                    <a :href="route('camera.video',rec.replaceAll('/','-'))"
                                       class="btn btn-primary btn-sm "
                                             @click.prevent="playvideo(rec)"
                                            :title="rec"
                                    ><PlayerPlayIcon></PlayerPlayIcon> Oynat</a>
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
    metaInfo:{title: "Kamera Kayıtları"},
    name: "Index",
    props:{
        camera_dir:String,
        camera:String,
        cameras:Array,
        camdirs:Array,
        record:String,
        records:Array
    },
    data(){
        return {
            video_url:null,
            camNames:{}
        }
    },

    beforeMount() {
        this.camNames = JSON.parse(localStorage.getItem('camNames'))
    },
    methods:{
        splitcam(cam){
            let cams =  cam.split('/')[1]

            let yil = cams.substr(0,4)
            let ay = cams.substr(4,2)
            let gun = cams.substr(6,2)
            let saat = cams.substr(8,2)
            return yil+ ' / '+ay+ ' / '+gun + ' :: '+ saat
        },
        splitrec(rec){
            return rec.replace(/^.*[\\\/]/, '')
        },
        playvideo(vid){
            this.video_url = route('camera.video',vid.replaceAll('/','-'))
        }
    }
}
</script>

<style scoped>

</style>
