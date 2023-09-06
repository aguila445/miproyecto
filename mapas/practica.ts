class Liebre {
    private origen: { x: number; y: number };
    private destino: { x: number; y: number };
  
    constructor(origenX: number, origenY: number, destinoX: number, destinoY: number) {
      this.origen = { x: origenX, y: origenY };
      this.destino = { x: destinoX, y: destinoY };
    }
  
    // Método para realizar un paso de la carrera
    carreraUnPaso(): void {
      const pasoX = this.generarNumeroAleatorio();
      const pasoY = this.generarNumeroAleatorio();
  
      // Controlar que no retroceda ni exceda el punto final
      if (
        this.origen.x + pasoX <= this.destino.x &&
        this.origen.y + pasoY <= this.destino.y
      ) {
        this.origen.x += pasoX;
        this.origen.y += pasoY;
      }
    }
  
    private generarNumeroAleatorio(): number {
      // Genera un número aleatorio entre -3 y 3
      return Math.floor(Math.random() * 7) - 3;
    }
  
    obtenerPosicion(): { x: number; y: number } {
      return this.origen;
    }
  }
  
  class Competencia {
    private liebres: Liebre[] = [];
  
    constructor() {
      // Inicializar las liebres con puntos de inicio y fin
      this.liebres.push(new Liebre(0, 0, 10, 10));
      this.liebres.push(new Liebre(0, 0, 10, 10));
      this.liebres.push(new Liebre(0, 0, 10, 10));
    }
  
    // Método para simular la carrera
    simularCarrera(): string {
      let ganador = '';
      let pasos = 0;
  
      while (ganador === '') {
        pasos++;
        for (let i = 0; i < this.liebres.length; i++) {
          this.liebres[i].carreraUnPaso();
  
          if (
            this.liebres[i].obtenerPosicion().x >= 10 &&
            this.liebres[i].obtenerPosicion().y >= 10 &&
            ganador === ''
          ) {
            ganador = `Liebre ${i + 1}`;
          }
        }
      }
  
      return `Ganador: ${ganador}, Total de pasos: ${pasos}`;
    }
  }
  
  const competencia = new Competencia();
  console.log(competencia.simularCarrera());