<template >
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
                v-model="day"
                v-on:input="Check"
                :min="new Date().toISOString().substr(0, 10)"
                class="form-control"
                required
              />
            </div>
          </div>
          <div class="card mt-4">
            <div class="card-body">
              <select v-model="id_time" class="form-select" required>
                <option
                  v-for="dt in data"
                  :value="dt.id_time"
                  :key="dt.id_time"
                >
                  {{ dt.val }}
                </option>
              </select>
            </div>
            <div class="card card-footer">
              <button @click.prevent="add" class="btn btn-primary">
                Add
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import HeaderVue from "./HeaderVue";
import axios from "axios";
export default {
  name: "RendezVous",
  data() {
    return {
      ref: null,
      day: null,
      id_time: null,
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
          this.day
      );
      // console.log(res.data);
      this.data = res.data;
    },
    add() {
      axios
        .post(
          "http://localhost/Api_cabinet/controllers/userController/add.php",
          { dayy: this.day, ref: this.ref, id_time: this.id_time }
        )
        .then((response) => {
          if (response.data.message == "Rendez vous réserver")
            this.$router.push({ name: "HomeVue" });
        });
    },
  },
  mounted() {
    let user = JSON.parse(localStorage.getItem("userInfo"));
    this.ref = user.ref;
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
}
.body h1 {
  color: white;
}
</style>