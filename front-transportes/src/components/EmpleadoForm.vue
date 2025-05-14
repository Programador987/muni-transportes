<template>
  <q-form @submit.prevent="enviarFormulario" class="q-gutter-md">
    <q-input v-model="form.nombre" label="Nombre" outlined dense required />
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
  nombre: ''
});

watch(() => props.empleado, (nuevo) => {
  if (nuevo) {
    form.id = nuevo.id || null;
    form.nombre = nuevo.nombre || '';
  } else {
    form.id = null;
    form.nombre = '';
  }
}, { immediate: true });

const enviarFormulario = () => {
  emit('guardar', { ...form });
};
</script>
