import { required, email } from "vee-validate/dist/rules";

export const seekerRegisterSchema = {
  name: { required },
  email: { required, email },
  phone: { required },
  password: { required },
};
