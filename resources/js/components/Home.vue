<template>
    <div>
        <nav class="panel column is-8 is-offset-2">
            <p class="panel-heading">
                PhoneBook
                <button class="button is-link is-rounded is-success" @click="AddNew">
                    <span class="icon is-small">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span>Add new</span>
                </button>
            </p>
            <div class="panel-block">
                <p class="control has-icons-left">
                <input class="input is-small" type="text" placeholder="search" v-model="searchQuery">
                <span class="icon is-small is-left">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </span>
                </p>
            </div>
            
            <a class="panel-block is-active" v-for="(list,index) in temp" :key="index">
                
                <span class=" column is-9">{{ list.name }}</span>
                <span class="panel-icon column is-1">
                    <i class="has-text-primary fas fa-edit" @click="OpenUpdate(index)"></i>
                </span>
                <span class="panel-icon column is-1">
                    <i class="fas fa-eye" @click="showOpen(index)" :openShow='ShowActive'></i>
                </span>
                <span class="panel-icon column is-1">
                    <i class="has-text-danger fas fa-trash" @click="deletePhoneBook(index,list.id)"></i>
                </span>
            </a> 
        </nav>
        <Add :openmodal='isActive' @closeRequest='close'></Add>
        <Show :openmodal='ShowActive' @closeRequest='close'></Show>
        <Update :openmodal='showUpdate' @closeRequest='close'></Update>
    </div> 
</template>

<script>
let Add = require("./Add.vue").default;
let Show = require("./Show.vue").default;
let Update = require("./Update.vue").default;
export default {
  data() {
    return {
      isActive: "",
      ShowActive: "",
      showUpdate: "",
      searchQuery: "",
      lists: {},
      errors: {},
      temp: {}
    };
  },
  mounted() {
    axios
      .post("/getData")
      .then(response => {
        this.lists = this.temp = response.data;
      })
      .catch(error => (this.errors = error.response.data.errors));
  },
  components: { Add, Show, Update },
  watch: {
    searchQuery() {
      if (this.searchQuery.length > 0) {
        this.temp = this.lists.filter(item => {
          return Object.keys(item).some(key => {
            let string = String(item[key]);
            return (
              string.toLowerCase().indexOf(this.searchQuery.toLowerCase()) > -1
            );
          });
        });
      } else {
        this.temp = this.lists;
      }
    }
  },
  methods: {
    AddNew() {
      this.isActive = "is-active";
    },
    OpenUpdate(index) {
      this.$children[2].list = this.temp[index];
      this.showUpdate = "is-active";
    },
    showOpen(index) {
      this.$children[1].list = this.temp[index];
      this.ShowActive = "is-active";
    },
    deletePhoneBook(index, id) {
      if (confirm("Are you sure ?")) {
        axios
          .delete("/phonebook/" + id)
          .then(response => {
            this.lists.splice(index, 1);
          })
          .catch(error => (this.errors = error.response.data.errors));
      }
    },
    close() {
      this.isActive = this.ShowActive = this.showUpdate = "";
    }
  }
};
</script>