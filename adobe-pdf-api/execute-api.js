const PDFServicesSdk = require('@adobe/pdfservices-node-sdk');
const files = [
    '2019r01a_fe_pm_qs'
];
console.log(files.length);

files.forEach(file => {

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
        const input = PDFServicesSdk.FileRef.createFromLocalFile(`${file}_unlocked.pdf`);
        ocrOperation.setInput(input);
    
        // Provide any custom configuration options for the operation.
        const options = new PDFServicesSdk.OCR.options.OCROptions.Builder()
            .withOcrType(PDFServicesSdk.OCR.options.OCRSupportedType.SEARCHABLE_IMAGE_EXACT)
            .withOcrLang(PDFServicesSdk.OCR.options.OCRSupportedLocale.JA_JP)
            .build();
        ocrOperation.setOptions(options);
    
        // Execute the operation and Save the result to the specified location.
        ocrOperation.execute(executionContext)
            .then(result => result.saveAsFile(`${file}/${file}-ocr.pdf`))
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
                `${file}_unlocked.pdf`,
                PDFServicesSdk.ExtractPDF.SupportedSourceFormat.pdf
            );
    
        // Set operation input from a source file.
        extractPDFOperation.setInput(input);
    
        // Set options
        extractPDFOperation.setOptions(options);
    
        extractPDFOperation.execute(executionContext)
            .then(result => result.saveAsFile(`${file}/images`))
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
    
});
