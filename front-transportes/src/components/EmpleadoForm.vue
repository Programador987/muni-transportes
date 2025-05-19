<template>
  <q-form @submit.prevent="enviarFormulario" class="q-gutter-md">
    <q-input v-model="form.nombre" label="Nombre" outlined dense required />
    <q-input v-model="form.apellido" label="Apellido" outlined dense />
    <q-input v-model="form.email" label="Email" outlined dense type="email" required />
    <q-input v-model="form.telefono" label="Teléfono" outlined dense />
    <q-input v-model="form.DNI" label="DNI" outlined dense />

    <div class="row justify-end q-gutter-sm">
      <q-btn label="Cancelar" flat @click="$emit('cancelar')" />
      <q-btn label="Guardar" type="submit" color="primary" />
    </div>
  </q-form>
</template>

<script setup>
import { reactive, watch } from 'vue';

const props = defineProps({
  empleado: Object,
});

const emit = defineEmits(['guardar', 'cancelar']);

const form = reactive({
  id: null,
  nombre: '',
  apellido: '',
  email: '',
  telefono: '',
  DNI: ''
});

watch(() => props.empleado, (nuevo) => {
  if (nuevo) {
    form.id = nuevo.id || null;
    form.nombre = nuevo.nombre || '';
    form.apellido = nuevo.apellido || '';
    form.email = nuevo.email || '';
    form.telefono = nuevo.telefono || '';
    form.DNI = nuevo.DNI || '';
  } else {
    form.id = null;
    form.nombre = '';
    form.apellido = '';
    form.email = '';
    form.telefono = '';
    form.DNI = '';
  }
}, { immediate: true });

const enviarFormulario = () => {
  emit('guardar', { ...form });
};
</script>
