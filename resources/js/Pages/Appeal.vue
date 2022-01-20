<template>
  <div style="background-color: #f1fae9" class="pb-10">
    <jet-authentication-card>
      <template #logo>
        <jet-authentication-card-logo />
      </template>

      <jet-validation-errors class="mb-4" />

      This is the appeal form for reported users. Once filled up, the
      administrators will review your appeals.

      <form @submit.prevent="submit">
        <div class="mt-4">
          <jet-label for="email" value="Email" />
          <jet-input
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            required
          />
        </div>

        <div class="mt-4">
          <jet-label for="password_confirmation" value="Confirm Password" />
          <jet-input
            id="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
          />
        </div>

        <div class="flex items-center justify-end mt-4">
          <jet-button
            class="ml-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Appeal
          </jet-button>
        </div>
      </form>
    </jet-authentication-card>
  </div>
</template>

<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import Select from "@/Components/Select";

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Select,
  },

  data() {
    return {
      form: this.$inertia.form({
        mname: "",
        lname: "",
        fname: "",
        name: "",
        email: "",
        birthdate: "",
        city: "",
        contact_number: "",
        password: "",
        password_confirmation: "",
        terms: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.name =
        this.form.fname +
        " " +
        this.form.mname.charAt(0) +
        ". " +
        this.form.lname;

      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>
