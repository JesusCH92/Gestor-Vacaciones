### **Levantar el entorno de trabajo con mysql:**
```
$docker-compose -f docker-compose.yml -f docker-compose.db.yml up -d
```

### **Entrar en modo interactive:**
```
$make interactive
```

### **Eliminar los contenedores:**
```
$make remove

o

$docker rm -f $(docker ps -aq)
```
