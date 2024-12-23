import { Sequelize } from "sequelize";

const db =  new  Sequelize('terranusaofc', 'root', '', {
    host:'localhost',
    dialect:'mysql'
});

export default db;