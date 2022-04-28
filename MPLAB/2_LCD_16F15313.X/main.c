
#include    "mcc_generated_files/mcc.h"
#include    <stdio.h>
#include    <stdlib.h>
#include    <string.h>
#include    "seri_lcd.h"




const char* String(char str1[], char str2[]) {
    // Get the two Strings to be concatenated
//    str1 = "Hola";
//    str2 = "World";
  
    // Declare a new Strings
    // to store the concatenated String
    char str3[32];
  
    int i = 0, j = 0;
  
 
    // Insert the first string in the new string
    while (str1[i] != '\0') {
        str3[j] = str1[i];
        i++;
        j++;
    }
  
    // Insert the second string in the new string
    i = 0;
    while (str2[i] != '\0') {
        str3[j] = str2[i];
        i++;
        j++;
    }
    str3[j] = '\0';
//  
//    // Print the concatenated string
//    
    return str3;  
    
}
void main(void)
{    
    int num = 10;
    float num_float = 10.01;
    char hola[] = "Hola";
    char hola1[8] = " adios" ;
    
    SYSTEM_Initialize(); // initialize the device
    // When using interrupts, you need to set the Global and Peripheral Interrupt Enable bits
    // Use the following macros to:
    INTERRUPT_GlobalInterruptEnable(); // Enable the Global Interrupts  
    INTERRUPT_PeripheralInterruptEnable(); // Enable the Peripheral Interrupts
    //INTERRUPT_GlobalInterruptDisable(); // Disable the Global Interrupts
    //INTERRUPT_PeripheralInterruptDisable(); // Disable the Peripheral Interrupts
    __delay_ms(500);
    lcd_start();
    
    
 
    while(1){
        
//          **************************************************  
            lcd_delete();
             __delay_ms(50);
            lcd_writemessage(1,1,"Hola Mundo by"); // ( Linea/ Posicion/ Mensanje)       
            lcd_writemessage(2,3,"AramisRanirez");// ( Linea/ Posicion/ Mensanje)
            __delay_ms(1000);
            lcd_delete();        
            lcd_writemessage(1,1,"Si se pudo "); // ( Linea/ Posicion/ Mensanje)       
            lcd_writemessage(2,3,"%d", num);// ( Linea/ Posicion/ Mensanje)   
            __delay_ms(1000);
//          **************************************************  .
            
            
            
            
      
        
        
        
        
        
    }
}
