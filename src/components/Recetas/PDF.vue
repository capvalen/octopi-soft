<template>
  <button @click="generatePDF">Generar PDF</button>
</template>

<script>
import jsPDF from 'jspdf';
import pdfjsLib from 'pdfjs-dist';

export default {
  methods: {
    generatePDF() {
      const doc = new jsPDF();
			doc.text('Hola, este es un PDF generado desde Vue.js', 10, 10);

			// Obtienes los datos del PDF generado
			const pdfData = doc.output('arraybuffer');

			// Conviertes los datos del PDF a una URL usando Blob
			const pdfBlob = new Blob([pdfData], { type: 'application/pdf' });
			const pdfUrl = URL.createObjectURL(pdfBlob);
			// Llamas a la función para mostrar el PDF en el visor
			this.displayPDF(pdfUrl);
    },
		displayPDF(url){
			const loadingTask = pdfjsLib.getDocument(url);
			loadingTask.promise.then(pdf => {
				// Puedes trabajar con el PDF aquí, por ejemplo, renderizarlo en un elemento HTML
				pdf.getPage(1).then(page => {
					const scale = 1.5;
					const viewport = page.getViewport({ scale });

					const canvas = document.createElement('canvas');
					const context = canvas.getContext('2d');
					canvas.height = viewport.height;
					canvas.width = viewport.width;

					const renderContext = {
						canvasContext: context,
						viewport: viewport
					};

					page.render(renderContext).promise.then(() => {
						document.body.appendChild(canvas);
					});
				});
			}, reason => {
				console.error(reason);
			});
		}
  }
};
</script>