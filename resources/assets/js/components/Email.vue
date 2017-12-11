<template>

	<div>
		<div class="row">
			
			
			<!-- UserLogado Email: {{ emailuserlogado }} <br>
			IdUser: {{ iduser }}<br>

			segundo Palano ou seja Users ao Logados<br>

			{{ email.from }} <br>  {{ email.user_id }} -->


			<div class="col-md-2">
				<div class="panel-default">
					<div class="panel-body">
						Operations


						<div class="form-group">
							<button type="submit" class="btn btn-danger btn-sm" v-on:click.prevent="CaixaMensagem" >Inbox</button>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-success btn-sm" v-on:click.prevent="Form" >Send</button>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-info btn-sm" v-on:click.prevent="TableSent2" >Sent</button>
						</div>

					<!-- <div class="form-group">
						<a class="btn btn-info btn-sm" href="/emails/enviados">Sent</a>
					</div> -->

				</div>

			</div>

		</div>

		<div class="col-md-10">


			<table class="table table-bordered table-hover table-responsive" v-if="Tableemail">
				<caption><strong class="text-danger">{{ totalemail }}</strong>  <small class="text-success">Mensagens</small></caption>
				<thead>
					<tr>
						<th>from</th>
						<th>Assunto</th>
						<th>Mensagem</th>
						<th>Estado</th>
						<th>Recido Em</th>
						<th>Operacoes</th>

					</tr>
				</thead>
				<tbody>

					<tr v-for="email  in emails">

						<td>{{ email.from }}</td>
						<td>{{ email.assunto }}</td>
						<td>{{ email.corpo }}</td>
						<td>{{ email.estado }}</td>
						<td>{{ email.created_at | myOwnTime }}</td>
						<td><button class="btn btn-info btn-sm">Ler</button></td>


					</tr>

				</tbody>
			</table>

			<!-- Formulario -->
			<div v-if="Formenviar">

				<form  v-on:submit.prevent="createEmail" method="POST">

					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1"  v-model="email.to" list="nomes">
						

						<datalist id="nomes">
							<option v-for="r in remetentes" v-text="r.email" v-bind:value="r.email"></option>
						</datalist>
						

					</div>

					<div class="form-group">
						<label for="exampleInputPassword1">Assunto</label>
						<input type="texte" class="form-control" id="exampleInputPassword1" v-model="email.assunto">
					</div>
					<input type="hidden"  v-model="email.estado">
					<input type="hidden" v-model="email.user_id">
					<input type="hidden" v-model="email.from" >


					<div class="form-group">
						<label for="assunto">Corpo</label>
						<textarea v-model="email.corpo" cols="10" rows="4" id="corpo" class="form-control" ></textarea>
					</div>

					<button type="submit" class="btn btn-primary">Send</button>
				</form>
			</div>

			<!-- // Emails Enviados -->
			<div v-if="TableSent">
				<table class="table table-bordered table-hover table-responsive">

					<caption><strong class="text-danger">{{ totalsentemail }}</strong>  <small class="text-success">Sent Emails</small></caption>
					<thead>
						<tr>
							<th>to</th>
							<th>Assunto</th>
							<th>Mensagem</th>
							<th>Estado</th>
							<th>Recido Em</th>
							<!-- <th>Operacoes</th> -->

						</tr>
					</thead>
					<tbody>

						<tr v-for="m in sentemails ">

							<td>{{ m.to}}</td>
							<td>{{ m.assunto}}</td>
							<td>{{ m.corpo}}</td>
							<td>{{ m.estado}}</td>
							<td>{{ m.created_at | myOwnTime }}</td>

						</tr>

					</tbody>
				</table>


			</div>







		</div>

	</div>

</div>

</template>


<script>
export default {
	data(){
		return{
			emails: [],
			remetentes: [],
			sentemails:[],
			totalsentemail: '',
			
			email: {
				to: '',
				assunto: '',
				corpo: '',
				estado: 'recebida',
				user_id: '1',
				from:'misaelvasco@gmail.com'
			},
			emailuserlogado:'',
			iduser: '',
			totalemail: '',
			Formenviar:false,
			Tableemail:true,
			TableSent:false,
			// EmailsEnviados:false
		}
	},
	// user_id: '{{ Auth()->user()->id }}',
	// from:'{{ Auth()->user()->email }}'

	created (){
		this.buscarEmails();
		this.buscarTotalInbox();
		this.buscarUtilizadores();
		this.emailsEnviados();
		this.NumeroTotasentemails();
		Vue.filter('myOwnTime', function(value){
			return moment(value).fromNow();
		});

		this.UserLogado();
		this.IDUserLogado();
		this.MandarDados();
		


	},

	methods: {

       //buscar emails\
       buscarEmails(){
       	this.$http.get("emails2").then(response=>{this.emails=response.data.emails2
       		console.log(response)
       		setTimeout( this.buscarEmails,2000)
       	});
       },

       buscarTotalInbox(){
       	this.$http.get("totalinbox").then(response=>{this.totalemail=response.data.nrtotal
       		console.log(response)
       		setTimeout( this.buscarTotalInbox,2000)
       	})
       },

       createEmail(){

       	this.$http.post("/sendemail/", this.email).then(response => {this.emails.push(response.data.email)
       		console.log(response)
       		this.email={to:'', assunto:'',corpo:'',estado:'',user_id:'', from:''}
       	});

       },
       Form(){
       	this.Tableemail=false;
       	this.TableSent=false;

       	this.Formenviar=true;
       },

       CaixaMensagem(){
       	this.Tableemail=true;
       	this.Formenviar=false;
       	this.TableSent=false;
       },

       TableSent2(){
       	this.Tableemail=false;
       	this.Formenviar=false;

       	this.TableSent=true;
       },

       buscarUtilizadores()
       {
       	this.$http.get("users").then(response=>{this.remetentes=response.data.users
       		
       		console.log(response)
       		setTimeout( this.buscarUtilizadores,2000)
       	});
       },

       emailsEnviados(){

       	this.$http.get("emailsenviados").then(response=>{this.sentemails= response.data.sentemails
       		console.log(response)
       		setTimeout( this.emailsEnviados,2000)
       	});
       },

       NumeroTotasentemails(){
       	this.$http.get("numeroemailenviados").then(response=>{this.totalsentemail=response.data.nrsentemails});
       	setTimeout( this.NumeroTotasentemails,2000)
       },


       MandarDados(){
       	this.email.user_id=this.iduser;
       	this.email.from=this.emailuserlogado;
       	setTimeout(this.MandarDados, 100);
       },

       UserLogado(){
       	this.$http.get("userlogado").then(response=>{this.emailuserlogado=response.data.emaildouser
       		console.log(response.data)
       		//alert(response.data)
       	});
       },

       IDUserLogado(){
       	this.$http.get("iduserlogado").then(response=>{this.iduser=response.data.iduser
       		console.log(response.data)
       		//alert(response.data)
       	});
       },



   }








}	

</script>