<template>
 <div class="modal" :class="openmodal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ list.name }}'s information</p>
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
                <br>
                <li class="panel-block">
                    <label for="column is-2"></label> {{ list.name }}
                </li>
                <li class="panel-block">
                    <label for="column is-2"></label> {{ list.phone }}
                </li>
                <li class="panel-block">
                    <label for="column is-2"></label> {{ list.email }}
                </li> 
            </section>
            <footer class="modal-card-foot">
                 <button class="button" @click='close'>Annuler</button>
            </footer>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      list: ""
    };
  },
  props: ["openmodal"],
  methods: {
    close() {
      this.$emit("closeRequest");
    }
  }
};
</script>