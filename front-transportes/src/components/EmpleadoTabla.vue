<template>
  <q-table
    :rows="empleados"
    :columns="columns"
    row-key="id"
    :loading="loading"
    loading-label="Cargando empleados..."
    flat
    bordered
  >
    <template v-slot:body-cell-acciones="props">
      <q-td align="center">
        <q-btn icon="edit" color="green" size="sm" @click="$emit('editar', props.row)" />
        <q-btn icon="delete" color="red" size="sm" @click="$emit('eliminar', props.row.id)" class="q-ml-sm" />
      </q-td>
    </template>
  </q-table>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

defineProps({
  empleados: {
    type: Array,
    required: true
  },
  loading: {
    type: Boolean,
    default: false
  }
});

defineEmits(['editar', 'eliminar']);

const columns = [
  { name: 'id', label: 'ID', align: 'left', field: 'id', sortable: true },
  { name: 'nombre', label: 'Nombre', align: 'left', field: 'nombre', sortable: true },
  { name: 'apellido', label: 'Apellido', align: 'left', field: 'apellido', sortable: true },
  { name: 'email', label: 'Email', align: 'left', field: 'email', sortable: true },
  { name: 'telefono', label: 'Teléfono', align: 'left', field: 'telefono', sortable: true },
  { name: 'DNI', label: 'DNI', align: 'left', field: 'DNI', sortable: true },
  { name: 'acciones', label: 'Acciones', align: 'center' }
];
</script>
