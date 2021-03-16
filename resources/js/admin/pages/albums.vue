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
                            <p class="_title0">ALBUMS  <Button @click="addModal = true"><Icon type="md-add" /> Add album</Button> </p>
                        <div class="space">
                           <Input v-model="keyword" placeholder="Search albums" />
                           </div>
                        <table id="datatable" class="table table-striped table-bordered lms-font-color-brown lms-font-family-roboto-slab" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>USER ID</th> 
                                    <th>TITLE</th>  
                                    <th>ACTION</th>
                                            

                                </tr>
                            </thead>

                    
                         <tbody v-if="results !==null">
                             
                    	<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
                            <tr v-for="(album, i) in filterAlbums" :key="i" v-if="albums.length">
                                <td>{{album.id}}</td>
                                <td class="_table_name">{{album.userId}}</td>
                                 <td>{{ album.title }}</td>
                               
                              
                                <td>
                                <div class="btn-group">
                                    <!-- <button class="btn btn-secondary btn-sm" title="View User Logs" @click="viewUserLogs(user)"><i class="fas fa-list-alt"></i></button> -->
                                    <button class="btn btn-sm btn-warning" @click="showEditModal(album, i)"><i class="fa fa-edit"></i></button>
                                     <button class="btn btn-sm btn-danger" @click="showDeletingModal(album, i)"><i class="fa fa-trash"></i></button>
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
                    title="Add album"
                    :mask-closable="false"
                    :closable="false"
                    >
                    <Input v-model="data.title" placeholder="Name" />

                    <div slot="footer">
                        <Button type="default" @click="addModal = false">Close</Button>
                        <Button type="primary" @click="addAlbum" 
                                    :disabled="isAdding" 
                                    :loading="isAdding"
                                    >{{isAdding ? 'Updating..' : 'Add album' }}</Button>
                    </div>
                </Modal>

	    <Modal
            v-model="editModal"
            title="Edit album"
            :mask-closable="false"
            :closable="false"
            >
            <Input v-model="editData.title" placeholder="Edit album" />

            <div slot="footer">
                <Button type="default" @click="editModal = false">Close</Button>
                <Button type="primary" @click="editAlbum" 
                            :disabled="isAdding" 
                            :loading="isAdding"
                            >{{isAdding ? 'Updating..' : 'Edit Album' }}</Button>
            </div>
        </Modal>

        <Modal v-model="showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete album?</p>
						
					</div>
					<div slot="footer">
						<Button type="error" size="large" long 
						:loading="isDeleting"  
						:disabled="isDeleting"
						@click="deleteAlbum">Delete</Button>
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
        this.getAlbums();
    },
    data(){
            return{
                results: null,
                albums:{
                    title:'',
                   
                },
                data:{
                     title:'',
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

                },
                keyword:'',
                success_message: null,
                danger_message: null
            }
    },
       computed: {
            filterAlbums() {
            return this.albums.filter((album) => {
                return this.keyword.toLowerCase().split(' ').every(v => album.title.toLowerCase().includes(v));
            });
            }
        },
    methods:{
        getAlbums: async function(){
            axios.get('app/get_albums', {params: this.params}).then(response =>{
                            this.results = response.data.results
                            this.albums = response.data.results.data;
                           
                    })
        },
        getPage: function(event){
                this.params.page = event;
                window.scrollTo(0, 0);
                this.getAlbums()
        },


        async addAlbum(){
			if(this.data.title.trim() == '')
			return this.error('Title is required');


			const res = await this.callApi('post', 'app/create_album',this.data);
			if(res.status == 201){
				 this.albums.unshift(res.data);
				 this.success('Album has been added successfully');
				 this.addModal = false;
				 this.data.title = '';
			}else{
				if(res.status == 422){
					
              
                    if(res.data.errors.title){
						this.error(res.data.errors.title[0])
					}
            
					
				}else{

                  
					this.swr();
				}
				 
			}
		},
        async editAlbum(){
			if(this.editData.title.trim() == '')
			return this.error('Title is required');
            
			const res = await this.callApi('post', 'app/edit_album',this.editData);
			if(res.status == 200){
				 this.albums[this.index].title = this.editData.title;

				 this.success('Edit has been edited successfully');
				 this.editModal = false;
                 
			}else{
				if(res.status == 422){
					if(res.data.errors.title){
						this.error(res.data.errors.title[0])
					}
   
					
				}else{
				this.flashDanger('Something went wrong');
				}
				 
			}

            
		},
        	async deleteAlbum(){

			this.isDeleting = true;
			const res = await this.callApi('post', 'app/delete_album',this.deleteItem);
			if(res.status === 200){
				this.albums.splice(this.deletingIndex,1);
				this.success('Album has been deleted successfully');
			}else{
				this.swr();
			}
			this.isDeleting = false;
			this.showDeleteModal = false;
		},
         showEditModal(album, index){
				let obj = {
					id: album.id,
					title: album.title,
				};
				this.editData = obj;
				this.editModal = true;
				this.index = index;
		},
        showDeletingModal(album, i){
				
				this.deleteItem = album;
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
                this.getAlbums();
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