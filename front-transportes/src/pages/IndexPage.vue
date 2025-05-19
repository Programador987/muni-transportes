<template>
  <q-page class="q-pa-md">
    <h2>Lista de Empleados</h2>
    <q-btn label="Agregar Empleado" color="blue" icon="add" @click="abrirFormulario()" />

    <q-separator class="q-my-md" />

    <EmpleadoTabla
      :empleados="empleados"
      :loading="loading"
      @editar="abrirFormulario"
      @eliminar="eliminarEmpleado"
    />

    <q-dialog v-model="dialogoVisible">
      <q-card class="q-pa-md" style="min-width: 400px">
        <EmpleadoForm
          :empleado="empleadoSeleccionado"
          @guardar="guardarEmpleado"
          @cancelar="cerrarFormulario"
        />
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import EmpleadoService from 'src/services/EmpleadoService';
import EmpleadoTabla from 'src/components/EmpleadoTabla.vue';
import EmpleadoForm from 'src/components/EmpleadoForm.vue';

const empleados = ref([]);
const loading = ref(false);
const dialogoVisible = ref(false);
const empleadoSeleccionado = ref(null);

const obtenerEmpleados = async () => {
  loading.value = true;
  try {
    const respuesta = await EmpleadoService.getData();
    empleados.value = respuesta.data.data;
  } catch (err) {
    console.error(err);
  } finally {
    loading.value = false;
  }
};

const abrirFormulario = (empleado = null) => {
  empleadoSeleccionado.value = empleado;
  dialogoVisible.value = true;
};

const cerrarFormulario = () => {
  empleadoSeleccionado.value = null;
  dialogoVisible.value = false;
};

const guardarEmpleado = async (empleado) => {
  try {
    if (empleado.id) {
      await EmpleadoService.actualizar(empleado.id, empleado);
    } else {
      const { ...empleadoDataSinId } = empleado;
      await EmpleadoService.crear(empleadoDataSinId);
    }
    await obtenerEmpleados();
    cerrarFormulario();
  } catch (err) {
    console.error(err);
  }
};

const eliminarEmpleado = async (id) => {
  if (confirm('¿Estás seguro de eliminar este empleado?')) {
    try {
      await EmpleadoService.eliminar(id);
      await obtenerEmpleados();
    } catch (err) {
      console.error(err);
    }
  }
};

onMounted(obtenerEmpleados);
</script>
