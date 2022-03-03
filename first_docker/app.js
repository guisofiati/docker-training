const express = require('express')
const app = express()
const port = 3000

app.get('/', (req, res) => {
    res.send('Imagem atualizada.')
})

app.listen(port, () => {
    console.log(`Executando na porta: ${port}`)
})