<template>
    <app-layout title="Edit User">
        <div class="mb-8 flex justify-start max-w-3xl">
            <h1 class="font-bold text-3xl">
                <Link
                    class="text-indigo-400 hover:text-indigo-600"
                    :href="route('users')"
                    >Users</Link
                >
                <span class="text-indigo-400 font-medium">/</span>
                {{ form.name }}
            </h1>
            <!-- <img
                v-if="user.photo"
                class="block w-8 h-8 rounded-full ml-4"
                :src="user.photo"
            /> -->
        </div>
        <trashed-message v-if="current_user.deleted_at" class="mb-6" @restore="restore">
            This user has been deleted.
        </trashed-message>
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
                    <!-- <file-input
                        v-model="form.photo"
                        :error="errors.photo"
                        class="pr-6 pb-8 w-full lg:w-1/2"
                        type="file"
                        accept="image/*"
                        label="Photo"
                    /> -->
                </div>
                <div
                    class="
                        px-8
                        py-4
                        bg-gray-100
                        border-t border-gray-200
                        flex
                        items-center
                    "
                >
                    <button
                        v-if="!current_user.deleted_at"
                        class="text-red-600 hover:underline"
                        tabindex="-1"
                        type="button"
                        @click="destroy"
                    >
                        Delete User
                    </button>
                    <loading-button
                        :loading="sending"
                        class="btn-indigo ml-auto"
                        type="submit"
                        >Update User</loading-button
                    >
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
import TrashedMessage from "@/Shared/TrashedMessage";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AppLayout,
        LoadingButton,
        SelectInput,
        TextInput,
        FileInput,
        TrashedMessage,
        Link,
    },
    props: {
        errors: Object,
        current_user: Object,
    },
    remember: "form",
    data() {
        return {
            sending: false,
            form: {
                // first_name: this.current_user.first_name,
                // last_name: this.current_user.last_name,
                name: this.current_user.name,
                email: this.current_user.email,
                password: this.current_user.password,
                owner: this.current_user.owner,
                // photo: null,
            },
        };
    },
    methods: {
        submit() {
            var data = new FormData();
            // data.append("first_name", this.form.first_name || "");
            // data.append("last_name", this.form.last_name || "");
            data.append("name", this.form.name || "");
            data.append("email", this.form.email || "");
            data.append("password", this.form.password || "");
            data.append("owner", this.form.owner ? "1" : "0");
            // data.append("photo", this.form.photo || "");
            data.append("_method", "put");

            this.$inertia.post(this.route("users.update", this.current_user.id), data, {
                onStart: () => (this.sending = true),
                onFinish: () => (this.sending = false),
                onSuccess: () => {
                    if (Object.keys(this.$page.props.errors).length === 0) {
                        // this.form.photo = null;
                        this.form.password = null;
                    }
                },
            });
        },
        destroy() {
            if (confirm("Are you sure you want to delete this user?")) {
                this.$inertia.delete(this.route("users.destroy", this.current_user.id));
            }
        },
        restore() {
            if (confirm("Are you sure you want to restore this user?")) {
                this.$inertia.put(this.route("users.restore", this.current_user.id));
            }
        },
    },
};
</script>
