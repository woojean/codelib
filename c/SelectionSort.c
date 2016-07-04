/* 选择排序 */

#include "stdio.h"

#define LEN 26

void SelectionSort(int arr[],int len){
  
  int i,j,min,tmp;

  for(i = 0; i < len; i++){
    min = i;
    for(j = i; j < len; j++){
      if(arr[j] < arr[min]){
        min = j;
      }
    }
    tmp = arr[i];
    arr[i] = arr[min];
    arr[min] = tmp;
  }
}

int main(){
  
  int arr[LEN] = {18,15,1,2,19,20,3,12,13,14,20,15,20,4,5,6,7,16,17,10,15,8,9,10,11,20};
  int i;

  printf("array before sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]); 
  }
  
  SelectionSort(arr,LEN);

  printf("\narray after sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]);
  }
  printf("\n");
}

