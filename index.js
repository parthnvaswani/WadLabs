const express = require("express");
const path = require("path");
const mongoose = require("mongoose");

const app = express();

app.use(express.json());

// DB Config
const db = require("./config/keys").mongoURI;

// Connect to MongoDB
mongoose
  .connect(db, {
    useUnifiedTopology: true,
    useNewUrlParser: true,
  })
  .then(() => console.log("MongoDB Connected"))
  .catch((err) => console.log(err));

// Load User model
const User = require("./model/User");

app.get("/", (req, res) => {
  res.sendFile(path.join(__dirname, "views", "index.html"));
});
app.get("/tybca", (req, res) => {
  res.sendFile(path.join(__dirname, "views", "tybca.html"));
});
app.get("/addData", (req, res) => {
  res.sendFile(path.join(__dirname, "views", "addData.html"));
});

app.post("/api/addData", (req, res) => {
  User.findOne({ email: req.body.email })
    .then((user) => {
      if (user) {
        return res.status(400).json({ response: 0 });
      } else {
        const newUser = new User({
          name: req.body.name,
          email: req.body.email,
          address: req.body.address,
          age: req.body.age,
        });

        newUser.save().then((user) => res.json({ response: 1 }));
      }
    })
    .catch((err) => console.log(err));
});

app.use(express.static("public"));

const port = process.env.PORT || 3000;
app.listen(port);
