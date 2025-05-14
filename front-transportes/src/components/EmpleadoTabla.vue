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
        <q-btn icon="edit" color="primary" size="sm" @click="$emit('editar', props.row)" />
        <q-btn icon="delete" color="negative" size="sm" @click="$emit('eliminar', props.row.id)" class="q-ml-sm" />
      </q-td>
    </template>
  </q-table>
</template>

<script setup>
defineProps({
  empleados: Array,
  loading: Boolean,
});

defineEmits(['editar', 'eliminar']);

const columns = [
  { name: 'id', label: 'ID', align: 'left', field: 'id', sortable: true },
  { name: 'nombre', label: 'Nombre', align: 'left', field: 'nombre', sortable: true },
  { name: 'acciones', label: 'Acciones', align: 'center' }
];
</script>
