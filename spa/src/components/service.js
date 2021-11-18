import axios from '@/axios'
const route = "contact"
export default {

    getAll() {
        return axios.get(route)
    },

    store(stage) {
        return axios.post(route, stage)
    },

    update(stage) {
        return axios.put(route + '/' + stage.id, stage)
    },

    destroy(stage) {
        return axios.delete(route + '/' + stage.id)
    },

}
