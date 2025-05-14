import { api } from 'src/boot/axios';

class EmpleadoService {
  static async getData() {
    return await api.get('/api/empleados');
  }

  static async crear(data) {
    return await api.post('/api/empleados', data);
  }

  static async actualizar(id, data) {
    return await api.put(`/api/empleados/${id}`, data);
  }

  static async eliminar(id) {
    return await api.delete(`/api/empleados/${id}`);
  }
}

export default EmpleadoService;
