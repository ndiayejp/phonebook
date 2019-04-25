<template>
    <div class="modal" :class="openmodal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Ajouter un contact</p>
                <button class="delete"  @click='close'></button>
            </header>
            <section class="modal-card-body">
                <div class="file">
                    <label class="file-label">
                        <input class="file-input" type="file" name="avatar">
                        <span class="file-cta">
                        <span class="file-icon"> <i class="fas fa-upload"></i>  </span>
                        <span class="file-label">
                            Choisissez un avatar
                        </span>
                        </span>
                    </label>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" :class="{'is-danger':errors.name}" placeholder="Nom/Prénom" v-model="list.name">
                    </div>
                    <small v-if="errors.name" class="has-text-danger">{{ errors.name[0] }}</small>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" placeholder="Téléphone" v-model="list.phone"> 
                    </div>
                    <small v-if="errors.phone" class="has-text-danger">{{ errors.phone[0] }}</small>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" placeholder="Email" v-model="list.email">
                    </div>
                    <small v-if="errors.email" class="has-text-danger">{{ errors.email[0] }}</small>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" @click='save'>Enregistrer</button>
                <button class="button" @click='close'>Annuler</button>
            </footer>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      list: {
        name: "",
        phone: "",
        email: ""
      },
      errors: {}
    };
  },
  props: ["openmodal"],
  methods: {
    close() {
      this.$emit("closeRequest");
    },
    save() {
      axios
        .post("/phonebook", this.$data.list)
        .then(response => {
          this.close();
          this.list = "";
          this.$parent.lists.push(response.data);
        })
        .catch(error => (this.errors = error.response.data.errors));
    }
  }
};
</script>