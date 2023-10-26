import {Sequelize} from "sequelize";

const db = new Sequelize('PWL_TG4', 'root', '', {
    host: "localhost",
    dialect: "mysql"
});

export default db;