
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


### **Hacer una migración**
```
php bin/console make:migration
```

### **Migrar una migración**
```
php bin/console doctrine:migrations:migrate
```
