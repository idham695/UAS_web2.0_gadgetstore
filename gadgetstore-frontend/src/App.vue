<template>
  <v-app>
    <!-- Component Header -->
    <c-header />

    <!-- Component Sidebar -->
    <c-side-bar />

    <!-- Konten Utama -->
    <v-content>
      <v-slide-y-transition mode="out-in">
        <router-view></router-view>
      </v-slide-y-transition>
    </v-content>

    <!-- Component Footer -->
    <c-footer />

    <c-alert />

    <!-- <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialogbottom-transition">
      <search />
    </v-dialog>-->

    <keep-alive>
      <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialogbottom-transition">
        <component :is="currentComponent"></component>
      </v-dialog>
    </keep-alive>
  </v-app>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import CHeader from "@/components/CHeader.vue";
import CFooter from "@/components/CFooter.vue";
import CSideBar from "@/components/CSideBar.vue";
import CAlert from "@/components/CAlert.vue";
export default {
  name: "App",
  components: {
    CHeader,
    CSideBar,
    CFooter,
    CAlert,
  },
  methods: {
    ...mapActions({
      setStatusDialog: "dialog/setStatus",
    }),
  },
  computed: {
    ...mapGetters({
      statusDialog: "dialog/status",
      currentComponent: "dialog/component",
    }),
    dialog: {
      get() {
        return this.statusDialog;
      },
      set(value) {
        this.setStatusDialog(value);
      },
    },
  },
};
</script>