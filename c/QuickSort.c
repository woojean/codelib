/* 快速排序 */

#include "stdio.h"

#define LEN 26

void QuickSort(int a[],int low,int high)
{
    int i = low;
    int j = high;  
    int temp = a[i]; 
  
    if( low < high)
    {          
        while(i < j) 
        {
            while((a[j] >= temp) && (i < j))
            { 
                j--; 
            }
            a[i] = a[j];
            while((a[i] <= temp) && (i < j))
            {
                i++; 
            }  
            a[j]= a[i];
        }
        a[i] = temp;
        QuickSort(a,low,i-1);
        QuickSort(a,j+1,high);
    }
}


int main(){
  
  int arr[LEN] = {18,15,1,2,19,20,3,12,13,14,20,15,20,4,5,6,7,16,17,10,15,8,9,10,11,20};
  int i;

  printf("array before sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]); 
  }
  
  QuickSort(arr,0,LEN);

  printf("\narray after sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]);
  }
  printf("\n");
}

