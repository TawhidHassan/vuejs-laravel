<template>
  <div>
    <nav class="panel">
  <p class="panel-heading">
     sifat data
    <button class="button is-link is-outlined" @click="openAdd">
      Add new
    </button>
    <span class="is-pulled-right" v-if="loading">
      <i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>
    </span>
  </p>
  <div class="panel-block">
    <p class="control has-icons-left">
      <input class="input is-small" type="text" placeholder="search" v-model="searchQuery">

      <span class="icon is-small is-left">
        <i class="fas fa-search" aria-hidden="true"></i>
      </span>
    </p>
  </div>
 
 
  <a class="panel-block" v-for="item,key in temp">
    <span class="is-9 column">
      {{key}} - {{item.name}}
    </span>
    <span class="panel-icon column is-1">
       <i class="has-text-danger fas fa-trash-alt" @click="del(key,item.id)"></i>
      </span>
       <span class="panel-icon column is-1">
      <i class="has-text-info fas fa-edit"  @click="openUpdate(key)"></i>
      </span>
       <span class="panel-icon column is-1">
       <i class="has-text-primary fas fa-eye" @click="openShow(key)"></i>
      </span>
  </a>
  </nav>
    <Add :openmodal='AddActive' @closeReuest='close'></Add>
     <Show :openmodal='showActive' @closeReuest='close'></Show>
     <Update :openmodal='updateActive' @closeReuest='close'></Update>
  </div>
</template>

<script>
  /*add forom*/
let Add = require('./Add.vue');
let Show = require('./Show.vue');
let Update = require('./Update.vue');
export default{
  components:{Add,Show,Update},
   
  data(){
    return{
      AddActive:'',
      showActive:'',
      updateActive:'',
      lists:{},
      loading:false,
      searchQuery:'',
      errors:{},
      temp:'',
      item:''
    }
  },
  watch:{ /*it is for search*/
    searchQuery(){
      if (this.searchQuery.length > 0) {
          this.temp = this.lists.filter((item) => {
            return Object.keys(item).some((key)=>{
              let string = String(item[key]) 
              return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
              // console.log(string)
            })
          });
          // console.log(result)
        }
      else{
        this.temp=this.lists
      }
    }
  },
  mounted(){
    axios.post('/getData').
    then((response)=> this.lists=this.temp =response.data)
    .catch((error) => this.errors=error.response.data.errors)
  },
  methods:{
    openAdd(){
      this.AddActive='is-active';
    },
    close(){
      this.AddActive='';
      this.showActive='';
      this.updateActive='';
    },
    openShow(key){
      this.$children[1].list=this.temp[key]
      this.showActive='is-active';
    },
    openUpdate(key){
      this.$children[2].list=this.temp[key]
      this.updateActive='is-active';
    },
    del(key,id){
      /*loading*/
       this.loading=!this.loading
      /*loading*/
      if(confirm("Are you sure?")){
      axios.delete(`/phonebook/${id}`)
      .then((response)=> {this.lists.splice(key,1);this.loading=!this.loading})
      .catch((error) => this.errors=error.response.data.errors)
      }
    }
    }
  }

</script>