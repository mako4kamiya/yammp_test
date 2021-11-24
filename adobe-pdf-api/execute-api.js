const PDFServicesSdk = require('@adobe/pdfservices-node-sdk');
const fs = require('fs');
const path = 'resource';
fs.readdir(path, (err, files) => {
    if (err) {
        return console.log('Unable to scan directory: ' + err);
    }
    files.forEach( (file) => {
        const fileNamearray = file.split('_unlocked.pdf');
        const fileName = fileNamearray[0];
        if (fs.existsSync(fileName)) {
            console.log(`${fileName}はすでに存在します。`);
        } else {
            // OCR処理
            try {
                // Initial setup, create credentials instance.
                const credentials =  PDFServicesSdk.Credentials
                    .serviceAccountCredentialsBuilder()
                    .fromFile("pdfservices-api-credentials.json")
                    .build();
            
                //Create an ExecutionContext using credentials and create a new operation instance.
                const executionContext = PDFServicesSdk.ExecutionContext.create(credentials),
                    ocrOperation = PDFServicesSdk.OCR.Operation.createNew();
            
                // Set operation input from a source file.
                const input = PDFServicesSdk.FileRef.createFromLocalFile(`${path}/${file}`);
                ocrOperation.setInput(input);
            
                // Provide any custom configuration options for the operation.
                const options = new PDFServicesSdk.OCR.options.OCROptions.Builder()
                    .withOcrType(PDFServicesSdk.OCR.options.OCRSupportedType.SEARCHABLE_IMAGE_EXACT)
                    .withOcrLang(PDFServicesSdk.OCR.options.OCRSupportedLocale.JA_JP)
                    .build();
                ocrOperation.setOptions(options);
            
                // Execute the operation and Save the result to the specified location.
                ocrOperation.execute(executionContext)
                    .then(result => result.saveAsFile(`${fileName}/${fileName}-ocr.pdf`))
                    .catch(err => {
                        if(err instanceof PDFServicesSdk.Error.ServiceApiError
                            || err instanceof PDFServicesSdk.Error.ServiceUsageError) {
                            console.log('Exception encountered while executing operation', err);
                        } else {
                            console.log('Exception encountered while executing operation', err);
                        }
                    });
            } catch (err) {
                console.log('Exception encountered while executing operation', err);
            }
            // 画像書き出し処理
            try {
                // Initial setup, create credentials instance.
                const credentials =  PDFServicesSdk.Credentials
                    .serviceAccountCredentialsBuilder()
                    .fromFile("pdfservices-api-credentials.json")
                    .build();
            
                // Create an ExecutionContext using credentials
                const executionContext = PDFServicesSdk.ExecutionContext.create(credentials);
            
                // Build extractPDF options
                const options = new PDFServicesSdk.ExtractPDF.options.ExtractPdfOptions.Builder()
                    .addElementsToExtract(PDFServicesSdk.ExtractPDF.options.ExtractElementType.TEXT)
                    .addElementsToExtractRenditions(PDFServicesSdk.ExtractPDF.options.ExtractRenditionsElementType.FIGURES)
                    .build()
            
                // Create a new operation instance.
                const extractPDFOperation = PDFServicesSdk.ExtractPDF.Operation.createNew(),
                    input = PDFServicesSdk.FileRef.createFromLocalFile(
                    `${path}/${file}`,
                    PDFServicesSdk.ExtractPDF.SupportedSourceFormat.pdf
                    );
            
                // Set operation input from a source file.
                extractPDFOperation.setInput(input);
            
                // Set options
                extractPDFOperation.setOptions(options);
            
                extractPDFOperation.execute(executionContext)
                    .then(result => result.saveAsFile(`${fileName}/images`))
                    .catch(err => {
                        if(err instanceof PDFServicesSdk.Error.ServiceApiError
                            || err instanceof PDFServicesSdk.Error.ServiceUsageError) {
                            console.log('Exception encountered while executing operation', err);
                        } else {
                            console.log('Exception encountered while executing operation', err);
                        }
                    });
            } catch (err) {
                console.log('Exception encountered while executing operation', err);
            }
        }
    });
});
