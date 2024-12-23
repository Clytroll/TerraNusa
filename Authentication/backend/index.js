import express from "express";
import cors from "cors";
import session from "express-session";
import { Sequelize } from "sequelize";

const app = express();
app.set('view engine', 'ejs');

app.get('/login', (req, res) => {
    res.render("login")
});

app.get('/signup', (req, res) => {
    res.render("signup");
})

const port = 3000;
app.listen(port, ()=> {
    console.log('Server up and running on port: ${port}');
});