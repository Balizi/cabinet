<template>
  <HeaderVue />
  <div class="body">
    <!-- <h1>Rendez-Vous Page</h1> -->
    <div class="container d-flex justify-content-center">
      <div class="col-md-7">
        <form>
          <div class="card mt-4">
            <div class="card-header">
              <input
                type="date"
                v-model="rendez.dayy"
                v-on:input="Check"
                :min="new Date().toISOString().substr(0, 10)"
                class="form-control"
                required
              />
            </div>
          </div>
          <div class="card mt-4">
            <div class="card-body">
              <select
                :value="data.id_time"
                v-model="rendez.val"
                class="form-select"
                required
              >
                <option disabled selected>{{ this.rendez.val }}</option>
                <option v-for="dt in data" :key="dt.id_time">
                  {{ dt.val }}
                </option>
              </select>
            </div>
            <div class="card card-footer">
              <button @click.prevent="edit" class="btn btn-primary">
                Update
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
// import axios from "axios";
import HeaderVue from "./HeaderVue.vue";
export default {
  name: "updateVue",
  data() {
    return {
      rendez: {
        id: null,
        dayy: "",
        datereservation: "",
        ref: "",
        id_time: null,
        val: "",
      },
      data: [],
    };
  },
  components: {
    HeaderVue,
  },
  methods: {
    async Check() {
      let res = await axios.get(
        "http://localhost/Api_cabinet/controllers/creneauController/times.php?day=" +
          this.rendez.day
      );
      console.log(res.data);
      this.data = res.data;
    },
    async edit() {
      await axios
        .delete(
          "http://localhost/Api_cabinet/controllers/creneauController/delete.php?id=" +
            this.$route.params.id
        )
        .then((response) => {
          if (response.data.message) {
            axios
              .post(
                "http://localhost/Api_cabinet/controllers/userController/add.php",
                {
                  dayy: this.rendez.dayy,
                  ref: this.rendez.ref,
                  id_time: this.rendez.id_time,
                }
              )
              .then((response) => {
                if (response.data.message == "Rendez vous réserver")
                  this.$router.push({ name: "HomeVue" });
              });
          }
        });
      // console.log(res);
    },
  },
  async mounted() {
    let user = JSON.parse(localStorage.getItem("userInfo"));
    if (!user) {
      this.$router.push({ name: "SignupVue" });
    }
    // console.log(this.$route.params.id);
    const result = await axios.get(
      "http://localhost/Api_cabinet/controllers/creneauController/edite.php?id=" +
        this.$route.params.id
    );
    this.rendez = result.data[0];
    console.log(this.rendez.val);
  },
};
</script>
<style>
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
}
.body h1 {
  color: white;
}
</style>