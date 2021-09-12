<template>
  <app-layout title="Create User">
    <h1 class="mb-8 font-bold text-3xl">
      <Link class="text-indigo-400 hover:text-indigo-600" :href="route('users')">Users</Link>
      <span class="text-indigo-400 font-medium"> / </span>Create
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <div class="pr-6 pb-8 w-full lg:w-1/2">
            <text-input
                v-model="form.name"
                :error="errors.name"
                label="Name"
            />
          </div>
          <div class="pr-6 pb-8 w-full lg:w-1/2">
            <text-input
              v-model="form.email"
              :error="errors.email"
              label="Email"
            />
          </div>
          <div class="pr-6 pb-8 w-full lg:w-1/2">
            <text-input
              v-model="form.password"
              :error="errors.password"
              type="password"
              autocomplete="new-password"
              label="Password"
            />
          </div>
          <div class="pr-6 pb-8 w-full lg:w-1/2">
            <select-input
              v-model="form.owner"
              :error="errors.owner"
              label="Owner"
            >
              <option :value="true">Yes</option>
              <option :value="false">No</option>
            </select-input>
          </div>
          <!-- <file-input v-model="form.photo" :error="errors.photo" class="pr-6 pb-8 w-full lg:w-1/1" type="file" accept="image/*" label="Photo" /> -->
        </div>
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
          <loading-button :loading="sending" class="btn-indigo" type="submit">Create User</loading-button>
        </div>
      </form>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import LoadingButton from "@/Shared/LoadingButton";
import SelectInput from "@/Shared/SelectInput";
import TextInput from "@/Shared/TextInput";
import FileInput from "@/Shared/FileInput";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    AppLayout,
    LoadingButton,
    SelectInput,
    TextInput,
    FileInput,
    Link,
  },
  props: {
    errors: Object,
  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        // first_name: null,
        // last_name: null,
        name: null,
        email: null,
        password: null,
        owner: false,
        // photo: null,
      },
    };
  },
  methods: {
    submit() {
      const data = new FormData();
      //   data.append('first_name', this.form.first_name || '')
      //   data.append('last_name', this.form.last_name || '')
      data.append("name", this.form.name || "");
      data.append("email", this.form.email || "");
      data.append("password", this.form.password || "");
      data.append("owner", this.form.owner ? "1" : "0");
      //   data.append('photo', this.form.photo || '')

      this.$inertia.post(this.route("users.store"), data, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>
