<template>
  <div>
    <v-subheader>Biodata 1</v-subheader>
    <v-card flat>
      <v-container>
        <v-simple-table>
          <tbody>
            <tr v-for="profil in profil1" :key="profil.key">
              <td>{{profil.key}}</td>
              <td>{{profil.value}}</td>
            </tr>
          </tbody>
        </v-simple-table>
      </v-container>
    </v-card>
    <v-subheader>Biodata 2</v-subheader>
    <v-card flat>
      <v-container>
        <v-simple-table>
          <tbody>
            <tr v-for="profil in profil2" :key="profil.key">
              <td>{{profil.key}}</td>
              <td>{{profil.value}}</td>
            </tr>
          </tbody>
        </v-simple-table>
      </v-container>
    </v-card>
  </div>
</template>
<script>
export default {
  data() {
    return {
      profil1: [
        {
          key: "Nama",
          value: "Idham Kholid",
        },
        {
          key: "NIM",
          value: "D11171013",
        },
        {
          key: "Kelas",
          value: "TI 6 RPL",
        },
        {
          key: "Alamat",
          value: "Jl. Melong Nyontrol No.42 RT 02 RW 03",
        },
      ],
      profil2: [
        {
          key: "Nama",
          value: "Nashrul Ahsanu Nadiya",
        },
        {
          key: "NIM",
          value: "D11171020",
        },
        {
          key: "Kelas",
          value: "TI 6 RPL",
        },
        {
          key: "Alamat",
          value: "Jl. Padat Karya rt 06, rw 04 no 14C, Cibeber, Cimahi Selatan",
        },
      ],
    };
  },
};
</script>