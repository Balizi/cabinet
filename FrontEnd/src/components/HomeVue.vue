<template >
  <HeaderVue />
  <div class="body">
    <!-- <h1>Home Page</h1> -->
    <div class="container d-flex">
      <div class="col-md-8">
        <div class="card mt-4" v-for="dt in dataPaginate" :key="dt.id">
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
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li v-on:click="getFirstPagi()" class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">First</span>
              </a>
            </li>
            <li v-on:click="getPreData()" class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li v-for="page in totalPaginate()" :key="page" v-on:click="getDataPaginate(page)" class="page-item"><a class="page-link" href="#">{{page}}</a></li>
            <li v-on:click="getNextData()" class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <li v-on:click="getLastPagi()" class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">Last</span>
              </a>
            </li>
          </ul>
        </nav>
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
      elementPagination:3,
      dataPaginate:[],
      currentPaginate: 1
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
      let ini=(1 * this.elementPagination) - this.elementPagination;
      let fin=(1 * this.elementPagination);
      this.dataPaginate=res.data.slice(ini,fin);
      this.data = res.data;
      // console.log(this.data);
    },
    totalPaginate()
    {
      return Math.ceil(this.data.length / this.elementPagination);
    },
    getDataPaginate(Current)
    {
      this.currentPaginate=Current;
      // this.dataPaginate=[];
      let ini=(Current * this.elementPagination) - this.elementPagination;
      let fin=(Current * this.elementPagination);
      this.dataPaginate=this.data.slice(ini,fin);
    },
    getPreData()
    {
      if(this.currentPaginate > 1)
      {
        this.currentPaginate--;
      }
      this.getDataPaginate(this.currentPaginate);
    },
    getNextData()
    {
      if(this.currentPaginate < this.totalPaginate())
      {
        this.currentPaginate++;
      }
      this.getDataPaginate(this.currentPaginate);
    },
    getFirstPagi()
    {
      this.getDataPaginate(1);
    },
    getLastPagi()
    {
      this.getDataPaginate(this.totalPaginate());
    }
  },
  mounted() {
    let user = JSON.parse(localStorage.getItem("userInfo"));
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
nav ul{
  margin: 80px auto;
  justify-content: center;
}
</style>