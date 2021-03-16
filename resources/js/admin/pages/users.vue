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
                            <p class="_title0">User  <Button @click="addModal = true"><Icon type="md-add" /> Add user</Button> </p>
                          <div class="space">
                           <Input v-model="keyword" placeholder="Search user" />
                           </div>
                        <table id="datatable" class="table table-striped table-bordered lms-font-color-brown lms-font-family-roboto-slab" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>   
                                    <th>EMAIL</th>
                                    <th>USERNAME</th>
                                    <th>PHONE</th>
                                    <th>WEBSITE</th>
                                    <th>ACTION</th>              

                                </tr>
                            </thead>

                    
                         <tbody v-if="results !==null">
                             
                    	<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
                            <tr v-for="(user, i) in filterUsers" :key="i" v-if="users.length">
                                <td>{{user.id}}</td>
                                <td class="_table_name">{{user.name}}</td>
                                <td>{{ user.email }}</td>
                                 <td> {{ user.username }}</td>
                                <td> {{ user.phone }}</td>
                                <td> {{ user.website }}</td>
                                <!-- <td> {{ user.company }}</td>
                                <td> {{ user.company.catchPhrase }}</td> -->
                                <td>
                                <div class="btn-group">
                                    <!-- <button class="btn btn-secondary btn-sm" title="View User Logs" @click="viewUserLogs(user)"><i class="fas fa-list-alt"></i></button> -->
                                    <button class="btn btn-sm btn-warning" @click="showEditModal(user, i)"><i class="fa fa-edit"></i></button>
                                     <button class="btn btn-sm btn-danger" @click="showDeletingModal(user, i)"><i class="fa fa-trash"></i></button>
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
                    title="Add user"
                    :mask-closable="false"
                    :closable="false"
                    >
                    <Input v-model="data.title" placeholder="Name" />
                    <div class="space">
                    <Input v-model="data.body" type="textarea" :autosize="{minRows: 2,maxRows: 5}" ></Input>
                    </div>

                    <div slot="footer">
                        <Button type="default" @click="addModal = false">Close</Button>
                        <Button type="primary" @click="addUser" 
                                    :disabled="isAdding" 
                                    :loading="isAdding"
                                    >{{isAdding ? 'Updating..' : 'Add user' }}</Button>
                    </div>
                </Modal>

	    <Modal
            v-model="editModal"
            title="Edit user"
            :mask-closable="false"
            :closable="false"
            >
            <Input v-model="editData.title" placeholder="Edit user" />
            <div class="space">
            <Input v-model="editData.body" type="textarea" :autosize="{minRows: 2,maxRows: 5}" ></Input>
            </div>

            <div slot="footer">
                <Button type="default" @click="editModal = false">Close</Button>
                <Button type="primary" @click="editUser" 
                            :disabled="isAdding" 
                            :loading="isAdding"
                            >{{isAdding ? 'Updating..' : 'Edit user' }}</Button>
            </div>
        </Modal>

        <Modal v-model="showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete user?</p>
						
					</div>
					<div slot="footer">
						<Button type="error" size="large" long 
						:loading="isDeleting"  
						:disabled="isDeleting"
						@click="deleteUser">Delete</Button>
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
        this.getUsers();
    },
    data(){
            return{
                results: null,
                users:{
                    name:'',
                    email:'',
                    username:'',
                    phone:'',
                    website:'',
                    company_name:'',
                    catchPhrase:'',
                    bs:'',
                    street:'',
                    suite:'',
                    city:'',
                    zipcode:'',
                    lat:'',
                    lng:''
                },
                data:{
                     name:'',
                    email:'',
                    username:'',
                    phone:'',
                    website:'',
                    company_name:'',
                    catchPhrase:'',
                    bs:'',
                    street:'',
                    suite:'',
                    city:'',
                    zipcode:'',
                    lat:'',
                    lng:''
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
                    name:'',
                    email:'',
                    username:'',
                    phone:'',
                    website:'',
                    company_name:'',
                    catchPhrase:'',
                    bs:'',
                    street:'',
                    suite:'',
                    city:'',
                    zipcode:'',
                    lat:'',
                    lng:''
                },
                success_message: null,
                danger_message: null,
                keyword:''
            }
    },
  computed: {
            filterUsers() {
            return this.users.filter((user) => {
                return this.keyword.toLowerCase().split(' ').every(v => user.name.toLowerCase().includes(v));
            });
            }
        },
    methods:{
        getUsers: async function(){
            axios.get('app/get_users', {params: this.params}).then(response =>{
                            this.results = response.data.results
                            this.users = response.data.results.data;
                           
                    })
        },
        getPage: function(event){
                this.params.page = event;
                window.scrollTo(0, 0);
                this.getUsers()
        },


        async addUser(){
			if(this.data.name.trim() == '')
			return this.error('Name is required');
            if(this.data.email.trim() == '')
			return this.error('Email is required');


			const res = await this.callApi('post', 'app/create_user',this.data);
			if(res.status == 201){
				 this.users.unshift(res.data);
				 this.success('User has been added successfully');
				 this.addModal = false;

				  this.data.name = '';
                  this.data.email = '';
                  this.data.username = '';
                  this.data.phone = '';
                  this.data.website = '';
                  this.data.catchPhrase = '';
                  this.data.company_name = '';
                  this.data.bs = '';
                  this.data.street = '';
                  this.data.suite = '';
                  this.data.city = '';
                  this.data.zipcode = '';
                  this.data.lat = '';
                  this.data.lng = '';
			}else{
				if(res.status == 422){
					
              
                    if(res.data.errors.title){
						this.error(res.data.errors.title[0])
					}
                    if(res.data.errors.body){
						this.error(res.data.errors.body[0])
					}
					
				}else{

                  
					this.swr();
				}
				 
			}
		},
        async editUser(){
			if(this.editData.name.trim() == '')
			return this.error('Title is required');
            if(this.editData.email.trim() == '')
			return this.error('Email is required');
            
			const res = await this.callApi('post', 'app/edit_user',this.editData);
			if(res.status == 200){
                
				 this.users[this.index].name = this.editData.name;
                 this.users[this.index].email = this.editData.email;
                 this.users[this.index].username = this.editData.username;
                 this.users[this.index].phone = this.editData.phone;
                 this.users[this.index].website = this.editData.website;
                 this.users[this.index].catchPhrase = this.editData.catchPhrase;
                 this.users[this.index].company_name = this.editData.company_name;
                 this.users[this.index].bs = this.editData.bs;
                 this.users[this.index].street = this.editData.street;
                 this.users[this.index].suite = this.editData.suite;
                 this.users[this.index].city = this.editData.city;
                 this.users[this.index].zipcode = this.editData.zipcode;
                  this.users[this.index].city = this.editData.lat;
                 this.users[this.index].zipcode = this.editData.lng;
				 this.success('User has been edited successfully');
				 this.editModal = false;
			}else{
				if(res.status == 422){
					if(res.data.errors.title){
						this.error(res.data.errors.title[0])
					}
                    if(res.data.errors.body){
						this.error(res.data.errors.body[0])
					}
					
				}else{
				this.flashDanger('Something went wrong');
				}
				 
			}

            
		},
        	async deleteUser(){

			this.isDeleting = true;
			const res = await this.callApi('post', 'app/delete_user',this.deleteItem);
			if(res.status === 200){
				this.users.splice(this.deletingIndex,1);
				this.success('User has been deleted successfully');
			}else{
				this.swr();
			}
			this.isDeleting = false;
			this.showDeleteModal = false;
		},

                    
         showEditModal(user, index){
				let obj = {
					id: user.id,
                    name:user.name,
                    email:user.email,
                    username:user.username,
                    phone:user.phone,
                    website:user.website,
                    company_name:user.company_name,
                    catchPhrase:user.catchPhrase,
                    bs:user.bs,
                    street:user.street,
                    suite:user.suite,
                    city:user.city,
                    zipcode:user.zipcode,
                    lat:user.lat,
                    lng:user.lng
				};
				this.editData = obj;
				this.editModal = true;
				this.index = index;
		},
        showDeletingModal(user, i){
				
				this.deleteItem = user;
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
                this.getUsers();
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