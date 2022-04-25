<template>
  <div class="nav">
    <a class="navbar-brand" href="#">
      <i class="fas fa-user"></i> Ref : {{ ref.ref }}
    </a>
    <router-link to="/">Home</router-link>
    <router-link to="Rendezvous">Prenez Rendez-vous</router-link>
    <a class="logout" v-on:click="logout" href="#">Logout</a>
  </div>
  
</template>
<script>
export default {
  name: "HeaderVue",
  data() {
    return {
      ref: JSON.parse(localStorage.getItem("userInfo")),
    };
  },
  methods: {
    logout() {
      localStorage.clear();
      this.$router.push({ name: "loginVue" });
    },
  },
};
</script>
<style>
.navbar{
    background-color: #333;
}
.navbar .container-fluid  a{
    background-color: red;
    color: #f2f2f2;
}
.navbar .container-fluid .collapse ul li a{
    color: white;
}
.nav {
  background-color: #333;
  overflow: hidden;
}
.nav a {
  float: left;
  color: #f2f2f2;
  padding: 14px 16px;
  text-align: center;
  font-size: 17px;
  text-decoration: none;
  margin-right: 5px;
}
.nav a.logout:hover{
    color: white;
    background-color: red;
}
.nav a:hover {
  background-color: #ddd;
  color: #333;
}
</style>