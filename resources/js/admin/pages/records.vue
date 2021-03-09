<template>
<div>
<div class="content">
	<div class="container-fluid">

	<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
	<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
		<p class="_title0">Record  <Button @click="addModal = true"><Icon type="md-add" /> Add Resident</Button> </p>
		

		<div class="_overflow _table_div">
			<table class="_table">
					<!-- TABLE TITLE -->
				<tr>
					<th>Resident ID</th>
					<th>Full Name</th>
					<th>Civil Status</th>
					<th>Gender</th>
					<th>Age</th>
					<th>Address</th>
					<th>Purok</th>
					<th></th>
				</tr>
					<!-- TABLE TITLE -->

  				<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
					<!-- ITEMS -->
				<tr v-for="(record, i) in records" :key="i" v-if="records.length">
					<td>{{record.id}}</td>
					<td class="_table_name">{{record.name}}</td>
					<td>{{record.civil_status}}</td>
					<td>{{record.gender}}</td>
					<td>{{record.age}}</td>
					<td>{{record.address}}</td>
					<td>{{record.purok}}</td>

					<td>
						<Button type="success" size="small" @click="showEditModal(record, i)">View</Button>
						<Button type="info" size="small" @click="showEditModal(record, i)">Edit</Button>
						<Button type="error" size="small" @click="showDeletingModal(record, i)"
							:loading="record.isDeleting"
						>Delete</Button>
						
					</td>
				</tr>
				


			</table>



		</div>
		</div>
				<!-- adding of new tag -->
				<Modal
					v-model="addModal"
					title="Add Record"
					:mask-closable="false"
					:closable="false"
					>
	
					<div class="space">
					<Input v-model="data.name" placeholder="Name" />
					</div>
						<div class="space">
						<DatePicker type="date" v-model="data.dob" placeholder="Date of Birth" style="width: 490px;"></DatePicker>
					<!-- <Input v-model="data.date" placeholder="Date Occured" /> -->
					</div>
					<div class="space">
					<Input v-model="data.civil_status" placeholder="Civil Status" />
					</div>
					<div class="space">
					<Input v-model="data.gender" placeholder="Gender" />
					</div>
					<div class="space">
					<Input v-model="data.age" placeholder="Age" />
					</div>
					<div class="space">
					<Input  v-model="data.address" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Address" />
					</div>
					<div class="space">
					<Input v-model="data.purok" placeholder="Purok" />
					</div>
					<div class="space">
					<Input v-model="data.educational_attainment" placeholder="Educational Attainment" />
					</div>
					<div class="space">
					<Input v-model="data.occupation" placeholder="Occupation" />
					</div>
					<div class="space">
					<Input v-model="data.spouse_name" placeholder="Name of Spouse if Married" />
					</div>
					<div class="space">
					<Input v-model="data.category" placeholder="Category" />
					</div>

					<div slot="footer">
						<Button type="default" @click="addModal = false">Close</Button>
						<Button type="primary" @click="addRecord" 
									:disabled="isAdding" 
									:loading="isAdding"
									>{{isAdding ? 'Adding..' : 'Add Record' }}</Button>
					</div>
				</Modal>

				<!-- editing -->
				<Modal
					v-model="editModal"
					title="Update Record"
					:mask-closable="false"
					:closable="false"
					>
					<!-- <Input v-model="editData.tagName" placeholder="Edit tag name" />
					 -->
					<div class="space">
					<Input v-model="editData.name" placeholder="Name" />
					</div>
						<div class="space">
						<DatePicker type="date" v-model="editData.dob" placeholder="Date of Birth" style="width: 490px;"></DatePicker>
					<!-- <Input v-model="editData.date" placeholder="Date Occured" /> -->
					</div>
					<div class="space">
					<Input v-model="editData.civil_status" placeholder="Civil Status" />
					</div>
					<div class="space">
					<Input v-model="editData.gender" placeholder="Gender" />
					</div>
					<div class="space">
					<Input v-model="editData.age" placeholder="Age" />
					</div>
					<div class="space">
					<Input  v-model="editData.address" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Address" />
					</div>
					<div class="space">
					<Input v-model="editData.purok" placeholder="Purok" />
					</div>
					<div class="space">
					<Input v-model="editData.educational_attainment" placeholder="Educational Attainment" />
					</div>
					<div class="space">
					<Input v-model="editData.occupation" placeholder="Occupation" />
					</div>
					<div class="space">
					<Input v-model="editData.spouse_name" placeholder="Name of Spouse if Married" />
					</div>
					<div class="space">
					<Input v-model="editData.category" placeholder="Category" />
					</div>

					<div slot="footer">
						<Button type="default" @click="editModal = false">Close</Button>
						<Button type="primary" @click="editRecord" 
									:disabled="isAdding" 
									:loading="isAdding"
									>{{isAdding ? 'Updating..' : 'Edit Record' }}</Button>
					</div>
				</Modal>
					<!-- delete alert modal -->
				<Modal v-model="showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete Record?</p>
						
					</div>
					<div slot="footer">
						<Button type="error" size="large" long 
						:loading="isDeleting"  
						:disabled="isDeleting"
						@click="deleteRecord">Delete</Button>
					</div>
				</Modal>
	</div>
</div>
</div>
</template>

<script>
import moment from 'moment';

export default {
	data(){
		return{
			data: {
				 name: '',
				'dob':'',
				'civil_status':'',
				'gender':'',
				'age':'',
				'address':'',
				'purok':'',
				'educational_attainment':'',
				'occupation':'',
				'spouse_name':'',
				'category':'',
			},
			addModal: false,
			editModal: false,
			isAdding: false,
			records: [],
			editData: {
				 name: '',
				'dob':'',
				'civil_status':'',
				'gender':'',
				'age':'',
				'address':'',
				'purok':'',
				'educational_attainment':'',
				'occupation':'',
				'spouse_name':'',
				'category':'',
			},
			index: -1,
			showDeleteModal: false,
			isDeleting: false,
			deleteItem:{},
			deletingIndex: -1
		}
	},
	methods:{
		async addRecord(){

			if(this.data.name.trim() == '')
			return this.error('Name is required');
			if(this.data.dob == '')
			return this.error('Date of Birth is required');
			if(this.data.civil_status.trim() == '')
			return this.error('Civil Status is required');
			if(this.data.gender.trim() == '')
			return this.error('Gender is required');
			if(this.data.address.trim() == '')
			return this.error('Address is required');
			if(this.data.purok.trim() == '')
			return this.error('Purok is required');
			
			// if(this.data.date.trim() == '')
			// return this.error('Date is required');
			

			const res = await this.callApi('post', 'app/create_record',this.data);
			if(res.status == 201){
				
				 this.records.unshift(res.data);
				 this.success('Record has been added successfully');
				 this.addModal = false;
				 this.data.name = '';
				 this.data.dob = '';
				 this.data.civil_status = '';
				 this.data.gender = '';
				 this.data.age = '';
				 this.data.address = '';
				 this.data.purok = '';
				 this.data.educational_attainment = '';
				 this.data.occupation = '';
				 this.data.spouse_name = '';
				 this.data.category = '';
			}else{
				if(res.status == 422){
					if(res.data.errors.name){
						this.error(res.data.errors.name[0])
					}
					if(res.data.errors.dob){
					this.error(res.data.errors.dob[0])
					}
					if(res.data.errors.civil_status){
						this.error(res.data.errors.civil_status[0])
					}
					if(res.data.errors.gender){
					this.error(res.data.errors.gender[0])
					}
					if(res.data.errors.age){
					this.error(res.data.errors.age[0])
					}
					if(res.data.errors.address){
					this.error(res.data.errors.address[0])
					}
					if(res.data.errors.purok){
						this.error(res.data.errors.purok[0])
					}
					if(res.data.errors.educational_attainment){
						this.error(res.data.errors.educational_attainment[0])
					}
					if(res.data.errors.occupation){
						this.error(res.data.errors.occupation[0])
					}
					if(res.data.errors.spouse_name){
						this.error(res.data.errors.spouse_name[0])
					}
					if(res.data.errors.category){
						this.error(res.data.errors.category[0])
					}
					
				}else{
					this.swr();
				}
				 
			}
		},
		// edit tag
		async editRecord(){
			if(this.editData.name.trim() == '')
			return this.error('Name is required');
			if(this.editData.dob == '')
			return this.error('Date of Birth is required');
			if(this.editData.civil_status.trim() == '')
			return this.error('Civil Status is required');
			if(this.editData.gender.trim() == '')
			return this.error('Gender is required');
			if(this.editData.address.trim() == '')
			return this.error('Address is required');
			if(this.editData.purok.trim() == '')
			return this.error('Purok is required');
			
			// if(this.editData.date.trim() == '')
			// return this.error('Date is required');
			
			const res = await this.callApi('post', 'app/edit_record',this.editData);
			if(res.status == 200){
				 this.records[this.index].name = this.editData.name;
				 this.records[this.index].dob = this.editData.dob;
				 this.records[this.index].purok = this.editData.purok;
				 this.records[this.index].civil_status = this.editData.civil_status;
				 this.records[this.index].gender = this.editData.gender;
				 this.records[this.index].address = this.editData.address;
				 this.records[this.index].educational_attainment = this.editData.educational_attainment;
				 this.records[this.index].occupation = this.editData.occupation;
				 this.records[this.index].spouse_name = this.editData.spouse_name;
				 this.records[this.index].category = this.editData.category;


				 this.success('Record has been edited successfully');
				 this.editModal = false;
			}else{
				if(res.status == 422){
					if(res.data.errors.name){
						this.error(res.data.errors.name[0])
					}
					if(res.data.errors.dob){
					this.error(res.data.errors.dob[0])
					}
					if(res.data.errors.civil_status){
						this.error(res.data.errors.civil_status[0])
					}
					if(res.data.errors.gender){
					this.error(res.data.errors.gender[0])
					}
					if(res.data.errors.age){
					this.error(res.data.errors.age[0])
					}
					if(res.data.errors.address){
					this.error(res.data.errors.address[0])
					}
					if(res.data.errors.purok){
						this.error(res.data.errors.purok[0])
					}
					if(res.data.errors.educational_attainment){
						this.error(res.data.errors.educational_attainment[0])
					}
					if(res.data.errors.occupation){
						this.error(res.data.errors.occupation[0])
					}
					if(res.data.errors.spouse_name){
						this.error(res.data.errors.spouse_name[0])
					}
					if(res.data.errors.category){
						this.error(res.data.errors.category[0])
					}
				}else{
					this.swr();
				}
				 
			}
		},
		// show modal of edit
		showEditModal(record, index){
				
				let obj = {
					id: record.id,
					name: record.name,
					'dob':record.dob,
					'civil_status':record.civil_status,
					'gender':record.gender,
					'age':record.age,
					'address':record.address,
					'purok':record.purok,
					'educational_attainment':record.educational_attainment,
					'occupation':record.occupation,
					'spouse_name':record.spouse_name,
					'category':record.category,
				};
				this.editData = record;
				this.editModal = true;
				this.index = index;
		},
		// show modal of delete
		showDeletingModal(record, i){
				
				this.deleteItem = record;
				this.deletingIndex  = i;
				this.showDeleteModal = true;
		},
		// delete tag
		async deleteRecord(){
			// add loading
			// this.$set(tag, 'isDeleting', true);
			this.isDeleting = true;
			const res = await this.callApi('post', 'app/delete_record',this.deleteItem);
			if(res.status === 200){
				this.records.splice(this.deletingIndex,1);
				this.success('Record has been deleted successfully');
			}else{
				this.swr();
			}
			this.isDeleting = false;
			this.showDeleteModal = false;
		}

	},

	async created(){
			const res = await this.callApi('get', '/app/get_records');
			if(res.status == 200){
			//  moment(res.data.dob).format('MM/DD/YYYY');
				this.records = res.data
				
			}else{
				this.swr();
			}
	}
}
</script>