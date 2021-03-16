<template>
   
        <div>
           <div class="container-add" id ="containerId" >
             
             
             <div class="container-main-add" style="margin-top:20px;"  v-if="active.dashboard">
                <div class="container-main-contentBox" >
                     <div class="small-box lms-color-white "> 
                        <div class="col-sm-12">
                            
                        <div class="alert-success alert" role="alert"
                            v-if="success_message !== null"
                        >
                            {{ success_message }} 
                        </div>

                        <div class="alert-danger alert" role="alert"
                            v-if="danger_message !== null"
                        >
                            {{ danger_message }} 
                            </div>
                            <p class="_title0">PHOTOS  <Button @click="addModal = true"><Icon type="md-add" /> Add photo</Button> </p>
                            <div class="space">
                           <Input v-model="keyword" placeholder="Search photo" />
                           </div>
                        <table id="datatable" class="table table-striped table-bordered lms-font-color-brown lms-font-family-roboto-slab" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ALBUM ID</th> 
                                    <th>TITLE</th>  
                                    <th>URL</th>
                                    <th>THUMBNAIL URL</th>
                                    <th>ACTION</th>
                                            

                                </tr>
                            </thead>

                    
                         <tbody v-if="results !==null">
                             
                    	<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
                            <tr v-for="(photo, i) in filterPhotos" :key="i" v-if="photos.length">
                                <td>{{photo.id}}</td>
                                <td class="_table_name">{{photo.albumId}}</td>
                                <td>{{ photo.title }}</td>
                                <td> <img :src="`${photo.url}`" style="width:50px;"/></td>
                                <td> <img :src="`${photo.thumbnailUrl}`" style="width:50px;"/></td>
                              
                                <td>
                                <div class="btn-group">
                                    <!-- <button class="btn btn-secondary btn-sm" title="View User Logs" @click="viewUserLogs(user)"><i class="fas fa-list-alt"></i></button> -->
                                    <button class="btn btn-sm btn-warning" @click="showEditModal(photo, i)"><i class="fa fa-edit"></i></button>
                                     <button class="btn btn-sm btn-danger" @click="showDeletingModal(photo, i)"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                            </tr>
                    </tbody>
                </table>
                 <PaginatorDetails
                    v-if="results !==null"
                    v-bind:results="results"
                        ></PaginatorDetails>
                <Paginator
                    v-if="results !==null"
                    v-bind:results="results"
                    v-on:get-page="getPage"
                ></Paginator>
                
            </div>
        </div>

    </div>


    </div>
</div>  
            <Modal
                    v-model="addModal"
                    title="Add photo"
                    :mask-closable="false"
                    :closable="false"
                    >
                     <div class="space">
                   <Input v-model="data.title" placeholder="Title" />
                    </div>
                    <div class="space">
                        <Input v-model="data.url" placeholder="URL" />
                    </div>
                    <div class="space">
                        <Input v-model="data.thumbnailUrl" placeholder="THUMBNAIL URL" />
                    </div>

                    <div slot="footer">
                        <Button type="default" @click="addModal = false">Close</Button>
                        <Button type="primary" @click="addPhoto" 
                                    :disabled="isAdding" 
                                    :loading="isAdding"
                                    >{{isAdding ? 'Updating..' : 'Add photo' }}</Button>
                    </div>
                </Modal>

	    <Modal
            v-model="editModal"
            title="Edit photo"
            :mask-closable="false"
            :closable="false"
            >
            
            <div class="space">
                <Input v-model="editData.title" placeholder="Edit title" />
            </div>
            <div class="space">
                <Input v-model="editData.url" placeholder="Edit url" />
            </div>
            <div class="space">
                <Input v-model="editData.thumbnailUrl" placeholder="Edit thumbnail url" />
            </div>

            <div slot="footer">
                <Button type="default" @click="editModal = false">Close</Button>
                <Button type="primary" @click="editPhoto" 
                            :disabled="isAdding" 
                            :loading="isAdding"
                            >{{isAdding ? 'Updating..' : 'Edit photo' }}</Button>
            </div>
        </Modal>

        <Modal v-model="showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete photo?</p>
						
					</div>
					<div slot="footer">
						<Button type="error" size="large" long 
						:loading="isDeleting"  
						:disabled="isDeleting"
						@click="deletePhoto">Delete</Button>
					</div>
				</Modal>
<router-view />
    </div>
</template>
<script>
import Paginator from '../../components/pagination/Paginator.vue';
import PaginatorDetails from '../../components/pagination/PaginatorDetails.vue';
export default {
     components:{
        Paginator,
        PaginatorDetails,
    },
     mounted(){
        this.getPhotos();
    },
    data(){
            return{
                results: null,
                photos:{
                    title:'',
                    url:'',
                    thumbnailUrl:''
                   
                },
                data:{
                     title:'',
                     url:'',
                    thumbnailUrl:''
                },
                addModal: false,
                editModal: false,
                isAdding: false,
                index: -1,
                showDeleteModal: false,
                isDeleting: false,
                deleteItem:{},
                deletingIndex: -1,
                 params:{
                    page:1
                  },
                  active:{
                dashboard:true,
                },
                editData: {
                    title: '',
                    url:'',
                    thumbnailUrl:''

                },
                success_message: null,
                danger_message: null,
                keyword:'',
            }
    },
    computed: {
            filterPhotos() {
            return this.photos.filter((photo) => {
                return this.keyword.toLowerCase().split(' ').every(v => photo.title.toLowerCase().includes(v));
            });
            }
        },
    methods:{
        getPhotos: async function(){
            axios.get('app/get_photos', {params: this.params}).then(response =>{
                            this.results = response.data.results
                            this.photos = response.data.results.data;
                           
                    })
        },
        getPage: function(event){
                this.params.page = event;
                window.scrollTo(0, 0);
                this.getPhotos()
        },


        async addPhoto(){
			if(this.data.title.trim() == '')
			return this.error('Title is required');
            if(this.data.url.trim() == '')
			return this.error('URL is required');
            if(this.data.thumbnailUrl.trim() == '')
			return this.error('Thumbnail URL is required');

			const res = await this.callApi('post', 'app/create_photo',this.data);
			if(res.status == 201){
				 this.photos.unshift(res.data);
				 this.success('Photo has been added successfully');
				 this.addModal = false;
				 this.data.title = '';
                 this.data.url ='';
                 this.data.thumbnailUrl = '';
			}else{
				if(res.status == 422){
					
              
                    if(res.data.errors.title){
						this.error(res.data.errors.title[0])
					}
                    if(res.data.errors.url){
						this.error(res.data.errors.url[0])
					}
                    if(res.data.errors.thumbnailUrl){
						this.error(res.data.errors.thumbnailUrl[0])
					}
            
					
				}else{

                  
					this.swr();
				}
				 
			}
		},
        async editPhoto(){
			if(this.editData.title.trim() == '')
			return this.error('Title is required');
            if(this.editData.url.trim() == '')
			return this.error('URL is required');
            if(this.editData.thumbnailUrl.trim() == '')
			return this.error('Thumbnail URL is required');

			const res = await this.callApi('post', 'app/edit_photo',this.editData);
			if(res.status == 200){
				 this.photos[this.index].title = this.editData.title;

				 this.success('Edit has been edited successfully');
				 this.editModal = false;
                 
			}else{
				if(res.status == 422){
					if(res.data.errors.title){
						this.error(res.data.errors.title[0])
					}
                    if(res.data.errors.url){
						this.error(res.data.errors.url[0])
					}
                    if(res.data.errors.thumbnailUrl){
						this.error(res.data.errors.thumbnailUrl[0])
					}
   
					
				}else{
				this.flashDanger('Something went wrong');
				}
				 
			}

            
		},
        	async deletePhoto(){

			this.isDeleting = true;
			const res = await this.callApi('post', 'app/delete_photo',this.deleteItem);
			if(res.status === 200){
				this.photos.splice(this.deletingIndex,1);
				this.success('Photo has been deleted successfully');
			}else{
				this.swr();
			}
			this.isDeleting = false;
			this.showDeleteModal = false;
		},
         showEditModal(photo, index){
				let obj = {
					id: photo.id,
					title: photo.title,
                    url: photo.url,
                    thumbnailUrl: photo.thumbnailUrl
				};
				this.editData = obj;
				this.editModal = true;
				this.index = index;
		},
        showDeletingModal(photo, i){
				
				this.deleteItem = photo;
				this.deletingIndex  = i;
				this.showDeleteModal = true;
		},
        setActive: function(component){
                Object.keys(this.active).forEach(key => this.active[key] = false);
                this.active[component] = true;
        },
          flashSuccessAndReload: function(event){
                this.setActive('dashboard');
                this.flashSuccess(event); 
                this.getPhotos();
        },
        flashSuccess: function(message){
            this.success_message = message;
            setTimeout(() => {
                this.success_message = null
            },5000);
        },
        flashDanger: function(message){
             this.danger_message = message;
            setTimeout(() => {
                this.danger_message = null
            },5000);
        }
    },

}
</script>
<style scoped>

.container-add
{
	width: auto;
	height:auto;
	margin-left: 250px;

}

table
{
	font-family:verdana;
	border-collapse: collapse;
	width: 100%;
}
td,th
{
	
	text-align: left;
	padding: 8px;
}



</style>