<template>
<div>
<div class="content">
	<div class="container-fluid">

	<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
	<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
		<p class="_title0">Report  <Button @click="addModal = true"><Icon type="md-add" /> Add Report</Button> </p>
		

		<div class="_overflow _table_div">
			<table class="_table">
					<!-- TABLE TITLE -->
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Respondent</th>
					<th>Reason</th>
					<th>Place Occured</th>
					<th>Time Occured</th>
					<th>Date Occured</th>
					<th></th>
				</tr>
					<!-- TABLE TITLE -->

  				<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
					<!-- ITEMS -->
				<tr v-for="(report, i) in reports" :key="i" v-if="reports.length">
					<td>{{report.id}}</td>
					<td class="_table_name">{{report.name}}</td>
					<td>{{report.respondent}}</td>
					<td>{{report.reason}}</td>
					<td>{{report.place}}</td>
					<td>{{report.time}}</td>
					<td>{{report.date}}</td>
					<td>
						<Button type="info" size="small" @click="showEditModal(report, i)">Edit</Button>
						<Button type="error" size="small" @click="showDeletingModal(report, i)"
							:loading="report.isDeleting"
						>Delete</Button>
						
					</td>
				</tr>
				


			</table>



		</div>
		</div>
				<!-- adding of new tag -->
				<Modal
					v-model="addModal"
					title="Add Report"
					:mask-closable="false"
					:closable="false"
					>
					<div class="space">
					<Input v-model="data.name" placeholder="Name" />
					</div>
					<div class="space">
					<Input v-model="data.respondent" placeholder="Respondent" />
					</div>
					<div class="space">
					<Input  v-model="data.reason" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Reason" />
					</div>
					<div class="space">
					<Input v-model="data.place" placeholder="Place occured" />
					</div>
					<div class="space">
					<Input v-model="data.time" placeholder="Time Occured" />
					</div>
					<div class="space">
						<DatePicker type="date" v-model="data.date" placeholder="Date Occured" style="width: 490px;"></DatePicker>
					<!-- <Input v-model="data.date" placeholder="Date Occured" /> -->
					</div>
					<div slot="footer">
						<Button type="default" @click="addModal = false">Close</Button>
						<Button type="primary" @click="addReport" 
									:disabled="isAdding" 
									:loading="isAdding"
									>{{isAdding ? 'Adding..' : 'Add Report' }}</Button>
					</div>
				</Modal>

				<!-- editing -->
				<Modal
					v-model="editModal"
					title="Update Report"
					:mask-closable="false"
					:closable="false"
					>
					<!-- <Input v-model="editData.tagName" placeholder="Edit tag name" />
					 -->
					<div class="space">
					<Input v-model="editData.name" placeholder="Name" />
					</div>
					<div class="space">
					<Input v-model="editData.respondent" placeholder="Respondent" />
					</div>
					<div class="space">
					<Input  v-model="editData.reason" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Reason" />
					</div>
					<div class="space">
					<Input v-model="editData.place" placeholder="Place occured" />
					</div>
					<div class="space">
					<Input v-model="editData.time" placeholder="Time Occured" />
					</div>
					<div class="space">
					<DatePicker type="date" v-model="editData.date" placeholder="Date Occured" style="width: 490px;"></DatePicker>
					<!-- <Input v-model="editData.date" placeholder="Date Occured" /> -->
					</div>
					<div slot="footer">
						<Button type="default" @click="editModal = false">Close</Button>
						<Button type="primary" @click="editReport" 
									:disabled="isAdding" 
									:loading="isAdding"
									>{{isAdding ? 'Updating..' : 'Edit Report' }}</Button>
					</div>
				</Modal>
					<!-- delete alert modal -->
				<Modal v-model="showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete Report?</p>
						
					</div>
					<div slot="footer">
						<Button type="error" size="large" long 
						:loading="isDeleting"  
						:disabled="isDeleting"
						@click="deleteReport">Delete</Button>
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
				'respondent':'',
				'reason':'',
				'place':'',
				'time':'',
				'date':''
				
			},
			addModal: false,
			editModal: false,
			isAdding: false,
			reports: [],
			editData: {
				 name: '',
				'respondent':'',
				'reason':'',
				'place':'',
				'time':'',
				'date':''
			},
			index: -1,
			showDeleteModal: false,
			isDeleting: false,
			deleteItem:{},
			deletingIndex: -1
		}
	},
	methods:{
		async addReport(){

			if(this.data.name.trim() == '')
			return this.error('Name is required');
			if(this.data.respondent.trim() == '')
			return this.error('Respondent is required');
			if(this.data.reason.trim() == '')
			return this.error('Reason is required');
			if(this.data.place.trim() == '')
			return this.error('Place is required');
			if(this.data.time.trim() == '')
			return this.error('Time is required');
			// if(this.data.date.trim() == '')
			// return this.error('Date is required');

			const res = await this.callApi('post', 'app/create_report',this.data);
			if(res.status == 201){
				 res.data.date = moment(res.data.date).format('MM/DD/YYYY');
				 this.reports.unshift(res.data);
				 this.success('Report has been added successfully');
				 this.addModal = false;
				 this.data.name = '';
				 this.data.respondent = '';
				 this.data.reason = '';
				 this.data.place = '';
				 this.data.time = '';
				 this.data.date = '';
			}else{
				if(res.status == 422){
					if(res.data.errors.name){
						this.error(res.data.errors.name[0])
					}
					
				}else{
					this.swr();
				}
				 
			}
		},
		// edit tag
		async editReport(){
			if(this.editData.name.trim() == '')
			return this.error('Name is required');
			if(this.editData.respondent.trim() == '')
			return this.error('Respondent is required');
			if(this.editData.reason.trim() == '')
			return this.error('Reason is required');
			if(this.editData.place.trim() == '')
			return this.error('Place is required');
			if(this.editData.time.trim() == '')
			return this.error('Time is required');
			// if(this.editData.date.trim() == '')
			// return this.error('Date is required');

			const res = await this.callApi('post', 'app/edit_report',this.editData);
			if(res.status == 200){
				 this.reports[this.index].name = this.editData.name;
				 this.reports[this.index].respondent = this.editData.respondent;
				 this.reports[this.index].reason = this.editData.reason;
				 this.reports[this.index].place = this.editData.place;
				 this.reports[this.index].time = this.editData.time;
				 this.reports[this.index].date = this.editData.date;

				 this.success('Report has been edited successfully');
				 this.editModal = false;
			}else{
				if(res.status == 422){
					if(res.data.errors.name){
						this.error(res.data.errors.name[0])
					}
					if(res.data.errors.respondent){
						this.error(res.data.errors.respondent[0])
					}
					if(res.data.errors.reason){
						this.error(res.data.errors.reason[0])
					}
					if(res.data.errors.place){
						this.error(res.data.errors.place[0])
					}
					if(res.data.errors.time){
						this.error(res.data.errors.time[0])
					}
					if(res.data.errors.date){
						this.error(res.data.errors.date[0])
					}
					
				}else{
					this.swr();
				}
				 
			}
		},
		// show modal of edit
		showEditModal(report, index){
				// let obj = {
				// 	id: report.id,
				// 	name: report.name,
				// 	respondent:,
				// 	reason,
				// 	place
				// };
				this.editData = report;
				this.editModal = true;
				this.index = index;
		},
		// show modal of delete
		showDeletingModal(report, i){
				
				this.deleteItem = report;
				this.deletingIndex  = i;
				this.showDeleteModal = true;
		},
		// delete tag
		async deleteReport(){
			// add loading
			// this.$set(tag, 'isDeleting', true);
			this.isDeleting = true;
			const res = await this.callApi('post', 'app/delete_report',this.deleteItem);
			if(res.status === 200){
				this.reports.splice(this.deletingIndex,1);
				this.success('Report has been deleted successfully');
			}else{
				this.swr();
			}
			this.isDeleting = false;
			this.showDeleteModal = false;
		}

	},

	async created(){
			const res = await this.callApi('get', '/app/get_reports');
			if(res.status == 200){
				this.reports = res.data
			}else{
				this.swr();
			}
	}
}
</script>