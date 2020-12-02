<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <h2>必要的联系</h2>
    <ul>
      <li>
        <router-link to="/">首页</router-link>
      </li>
      <li>
        <router-link to="/Record">档案</router-link>
      </li>
      <li>
        <router-link to="/About">关于我</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'Record',
  data () {
    return {
      msg: 'record'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
