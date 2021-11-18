<template>
  <v-container>
    <v-data-table
      :loading="loading_data_table"
      :headers="headers"
      :items="desserts"
      sort-by="corporate_name"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Contatos</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="800px" width="500">
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="primary"
                outlined
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
                >Novo contato</v-btn
              >
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-form class="px-3" @submit.prevent="submit()">
                    <v-row>
                      <v-col>
                        <v-text-field
                          dense
                          v-model="editedItem.name"
                          label="Nome"
                        ></v-text-field
                      ></v-col>
                    </v-row>
                    <v-row>
                      <v-col
                        ><v-text-field
                          dense
                          v-model="editedItem.email"
                          label="Email"
                        ></v-text-field
                      ></v-col>
                    </v-row>
                    <v-row>
                      <v-col
                        ><v-text-field
                          dense
                          v-model="editedItem.telephone"
                          label="Telefone"
                        ></v-text-field
                      ></v-col>
                    </v-row>
                    <v-row>
                      <v-col
                        ><v-text-field
                          dense
                          v-model="editedItem.file"
                          label="file"
                        ></v-text-field
                      ></v-col>
                    </v-row>
                    <v-row>
                      <v-col >
                        <v-textarea
                          dense
                          clearable
                          clear-icon="mdi-close-circle"
                          label="Menssagem"
                          v-model="editedItem.message"
                        ></v-textarea>
                      </v-col>
                    </v-row>
                  </v-form>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn class="mx-0 mt-3 mr-1" @click="dialog = false"
                  >Fechar</v-btn
                >
                <v-btn class="success mx-0 mt-3" @click="save">Salvar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <v-dialog v-model="dialogDelete" max-width="550px">
            <v-card>
              <v-card-title class="text-h5"
                >Tem certeza de que deseja excluir este item ?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="" @click="closeDelete">Cancelar</v-btn>
                <v-btn class="primary" @click="deleteItemConfirm">OK</v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon class="mr-2" @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data> Nenhum registro encontrado </template>
    </v-data-table>
  </v-container>
</template>


<script>
import service from "./service";
export default {
  data: () => ({
    loading_data_table: false,
    dialog: false,
    dialogDelete: false,
    headers: [
      { align: "start", sortable: false, text: "Nome", value: "name" },
      { text: "Email", value: "email" },
      { text: "Telefone", value: "telephone" },
      { text: "message", value: "message" },
      { text: "", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      id: "",
      name: "",
      email: "",
      telephone: "",
      message: "",
      file: "",
    },
    defaultItem: {
      id: "",
      name: "",
      email: "",
      telephone: "",
      message: "",
      file: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Novo Contato" : "Atualizar Contato";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.loading_data_table = true;
      service.getAll().then((response) => {
        this.desserts = response.data;
        this.loading_data_table = false;
      });
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      let editedIndex = this.editedIndex;
      service.destroy(this.editedItem).then(() => {
        this.desserts.splice(editedIndex, 1);
      });

      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    save() {
      if (this.editedIndex > -1) {
        //update
        let indice = this.editedIndex;
        service.update(this.editedItem).then((response) => {
          Object.assign(this.desserts[indice], response.data);
        });
      } else {
        //store
        service.store(this.editedItem).then((response) => {
          this.desserts.push(response.data);
        });
      }
      this.close();
    },
  },
};
</script>
