const datosDePrueba = [
      // --- Variante de Tarjeta de Partido ---
      {
        tipo: 'partido',
        jugadores: { actual: 8, total: 10 },
        detalle: '5 vs 5 • Hoy 18:00 hs',
        estado: { texto: 'Jugando', color: 'text-green-600' },
        lugar: 'Cancha Municipal',
        imagen: 'public/CanchaImage.png'
      },
      // --- Variante de Tarjeta de Usuario (Admin) ---
      {
        tipo: 'usuario',
        nombre: 'Pepito',
        rol: 'Delantero',
        id: '#48642',
        email: 'pepito@gmail.com',
        estado: { texto: 'Activo', color: 'text-green-600' },
        imagen: 'public/UsuarioImage.png',
        acciones: [
            { texto: 'Editar', clase: 'bg-blue-600 hover:bg-blue-700' },
            { texto: 'Eliminar', clase: 'bg-red-600 hover:bg-red-700' }
        ]
      },
      // --- Variante de Tarjeta de Notificación ---
      {
        tipo: 'notificacion',
        mensaje: '¡Tu partido en "Club San Martín" está por comenzar!',
        hora: 'Hace 3 minutos',
        icono: 'fa fa-bell' // Ejemplo con FontAwesome, si lo usaras
      },
      {
        tipo: 'partido',
        jugadores: { actual: 4, total: 10 },
        detalle: '5 vs 5 • Mañana 19:00 hs',
        estado: { texto: 'Buscando jugadores', color: 'text-yellow-500' },
        lugar: 'Club San Martín'
        // Sin imagen
      }
    ];

    const contenedor = document.getElementById('contenedor-partidos');
    datosDePrueba.forEach(dato => {
      // Llamamos a la nueva función principal
      const tarjeta = crearTarjeta(dato);
      contenedor.appendChild(tarjeta);
    });