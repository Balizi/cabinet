<template >
  <HeaderVue />
  <div class="body">
    <!-- <h1>Home Page</h1> -->
    <div class="container d-flex">
      <div class="col-md-8">
        <div class="card mt-4" v-for="dt in data" :key="dt.id">
          <h5 class="card-header">{{this.fullname}}</h5>
          <div class="card-body">
            <h5 class="card-title">
              Date Réservation : {{ dt.datereservation }}
            </h5>
            <h5 class="card-title">
              Date Rendez-vous : {{ dt.dayy }} {{ dt.val }}
            </h5>
            <router-link :to="'/update/' + dt.id" class="btn btn-warning"
              >Modifier</router-link
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import HeaderVue from "./HeaderVue";
import axios from "axios";
export default {
  name: "HomeVue",
  data() {
    return {
      fullname: "",
      data: [],
    };
  },
  created() {
    this.afficher();
  },
  components: {
    HeaderVue,
  },
  methods: {
    async afficher() {
      let user = JSON.parse(localStorage.getItem("userInfo"));
      let res = await axios.get(
        "http://localhost/Api_cabinet/controllers/userController/read.php?ref=" +
          user.ref
      );
      this.data = res.data;
      console.log(this.data);
    },
  },
  mounted() {
    let user = JSON.parse(localStorage.getItem("userInfo"));
    console.log(user.prenom);
    this.fullname=user.prenom+' '+user.nom;
    if (!user) {
      this.$router.push({ name: "SignupVue" });
    }
  },
};
</script>
<style scoped>
.body {
  background-image: url("./../assets/back.jpg");
  height: 100vh;
  width: 100%;
  margin: 0;
  padding: 0;

  background-position: cover;
  background-repeat: no-repeat;
  background-size: cover;
  margin: auto;
  position: fixed;
  overflow-y: scroll;
}
.container {
  display: flex;
  justify-content: center;
}
.card-header {
  background-color: #00b4d8;
  color: white;
}

.card-body {
  background-color: #caf0f8;
}

.container {
  /* margin-top: 60px; */
  margin-bottom: 10px;
}

.card {
  border: none;
}
</style>