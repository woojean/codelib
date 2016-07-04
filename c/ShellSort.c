/* 希尔排序 */

#include "stdio.h"

#define LEN 26

void ShellSort(int arr[],int len){
  
  int i,j,incr,tmp;
  
  // 14,7,3,1
  for(incr = len/2; incr > 0; incr /= 2){
    for(i = incr; i < len; i++){
      tmp = arr[i];
      for(j = i; j >= incr; j -= incr){
        if(tmp < arr[j-incr]){
          arr[j] = arr[j-incr];
        }
        else{
          break;
        }
      }
      arr[j] = tmp;
    }
  }
}

int main(){
  
  int arr[LEN] = {18,15,1,2,19,20,3,12,13,14,20,15,20,4,5,6,7,16,17,10,15,8,9,10,11,20};
  int i;

  printf("array before sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]); 
  }
  printf("\n");
  
  ShellSort(arr,LEN);

  printf("\narray after sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]);
  }
  printf("\n");
}

